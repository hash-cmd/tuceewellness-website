<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;
use PDO;

class AuthController extends Controller {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user'])) {
            header('Location: /tucee/dashboard');
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email format.';
            } else {
                try {
                    $db = new Database();
                    $conn = $db->connect();

                    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
                    $stmt->execute(['email' => $email]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($user && password_verify($password, $user['password'])) {
                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'email' => $user['email'],
                            'name' => $user['name']
                        ];
                        header('Location: /tucee/dashboard');
                        exit;
                    } else {
                        $error = 'Invalid email or password.';
                    }
                } catch (\PDOException $e) {
                    $error = 'Database error: ' . $e->getMessage();
                }
            }

            $this->view('login', ['error' => $error]);
            return;
        }

        $this->view('login');
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        header('Location: auth');
        exit;
    }
}
