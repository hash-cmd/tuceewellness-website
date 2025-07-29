<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;
use PDO;

class NewUserController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: auth');
            exit;
        }

        $error = null;
        $success = null;

        $db = new Database();
        $conn = $db->connect();

        // DELETE USER
        if (isset($_GET['delete'])) {
            $deleteEmail = $_GET['delete'];
            try {
                $stmt = $conn->prepare("DELETE FROM users WHERE email = :email");
                $stmt->execute(['email' => $deleteEmail]);
                $success = 'User deleted successfully.';
            } catch (\PDOException $e) {
                $error = 'Error deleting user: ' . $e->getMessage();
            }
        }

        // CHECK EDIT MODE
        $editUser = null;
        if (isset($_GET['edit'])) {
            $editEmail = $_GET['edit'];
            $stmt = $conn->prepare("SELECT name, email FROM users WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $editEmail]);
            $editUser = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // HANDLE FORM SUBMISSION
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if (empty($name) || empty($email)) {
                $error = 'Name and email are required.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email format.';
            } elseif (!str_ends_with($email, '@tuceewellness.com')) {
                $error = 'Email must end with @tuceewellness.com';
            } elseif (!$editUser && (empty($password) || empty($confirmPassword))) {
                $error = 'Password and confirmation required.';
            } elseif ($password !== $confirmPassword) {
                $error = 'Passwords do not match.';
            } else {
                try {
                    if ($editUser) {
                        $stmt = $conn->prepare("UPDATE users SET name = :name WHERE email = :email");
                        $stmt->execute([
                            'name' => $name,
                            'email' => $email
                        ]);
                        $success = 'User updated successfully.';
                    } else {
                        $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
                        $stmt->execute(['email' => $email]);
                        if ($stmt->fetch()) {
                            $error = 'Email already in use.';
                        } else {
                            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
                            $stmt->execute([
                                'name' => $name,
                                'email' => $email,
                                'password' => $hashedPassword
                            ]);
                            $success = 'User registered successfully.';
                        }
                    }
                } catch (\PDOException $e) {
                    $error = 'Database error: ' . $e->getMessage();
                }
            }
        }

        // FETCH USERS
        $users = [];
        try {
            $stmt = $conn->query("SELECT name, email FROM users ORDER BY id DESC");
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            $error = 'Database error: ' . $e->getMessage();
        }

        $this->view('newuser', [
            'error' => $error,
            'success' => $success,
            'users' => $users,
            'editUser' => $editUser
        ]);
    }
}
