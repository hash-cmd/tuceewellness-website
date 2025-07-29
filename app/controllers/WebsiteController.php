<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;
use PDO;

class WebsiteController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $timeout = 1800;
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
            session_unset();
            session_destroy();
            header('Location: /tucee/auth');
            exit;
        }
        $_SESSION['last_activity'] = time();

        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect_after_login'] = 'tucee/dashboard';
            header('Location: /tucee/auth');
            exit;
        }

        $db = new Database();
        $pdo = $db->connect();
        $success = null;
        $error = null;

        // === Handle structured HOME content ===
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'home_update') {
            // Fetch existing data
            $existing = [];
            $stmt = $pdo->prepare("SELECT key, value FROM home WHERE section = 'home'");
            $stmt->execute();
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $existing[$row['key']] = $row['value'];
            }

            $pdo->prepare("DELETE FROM home WHERE section = 'home'")->execute();

            // Save form values
            foreach ($_POST as $key => $value) {
                if ($key === 'form_type') continue;
                $stmt = $pdo->prepare("INSERT INTO home (section, key, value) VALUES (?, ?, ?)");
                $stmt->execute(['home', $key, $value]);
            }

            $uploadDir = "assets/upload/home/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            $imageKeys = ['ceo_image'];
            for ($i = 1; $i <= 3; $i++) $imageKeys[] = "carousel_img_$i";

            foreach ($imageKeys as $imgKey) {
                if (!empty($_FILES[$imgKey]['tmp_name'])) {
                    $fileName = uniqid() . "_" . basename($_FILES[$imgKey]["name"]);
                    $filePath = $uploadDir . $fileName;
                    if (move_uploaded_file($_FILES[$imgKey]["tmp_name"], $filePath)) {
                        $stmt = $pdo->prepare("INSERT INTO home (section, key, value) VALUES (?, ?, ?)");
                        $stmt->execute(['home', $imgKey, $filePath]);
                    }
                } elseif (!empty($existing[$imgKey])) {
                    // Preserve old image
                    $stmt = $pdo->prepare("INSERT INTO home (section, key, value) VALUES (?, ?, ?)");
                    $stmt->execute(['home', $imgKey, $existing[$imgKey]]);
                }
            }

            $success = "Home content updated successfully.";
        }

        $stmt = $pdo->prepare("SELECT key, value FROM home WHERE section = 'home'");
        $stmt->execute();
        $homeData = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $homeData[$row['key']] = $row['value'];
        }

        // === Handle structured ABOUT content ===
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'about_update') {
            // Fetch existing about data
            $existing = [];
            $stmt = $pdo->prepare("SELECT key, value FROM about WHERE section = 'about'");
            $stmt->execute();
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $existing[$row['key']] = $row['value'];
            }

            $pdo->prepare("DELETE FROM about WHERE section = 'about'")->execute();

            foreach ($_POST as $key => $value) {
                if ($key === 'form_type') continue;
                $stmt = $pdo->prepare("INSERT INTO about (section, key, value) VALUES (?, ?, ?)");
                $stmt->execute(['about', $key, $value]);
            }

            $uploadDir = "assets/images/";
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

            if (!empty($_FILES['about_carousel_img']['tmp_name'])) {
                $fileName = uniqid() . "_" . basename($_FILES['about_carousel_img']["name"]);
                $filePath = $uploadDir . $fileName;
                if (move_uploaded_file($_FILES['about_carousel_img']["tmp_name"], $filePath)) {
                    $stmt = $pdo->prepare("INSERT INTO about (section, key, value) VALUES (?, ?, ?)");
                    $stmt->execute(['about', 'about_carousel_img', $filePath]);
                }
            } elseif (!empty($existing['about_carousel_img'])) {
                $stmt = $pdo->prepare("INSERT INTO about (section, key, value) VALUES (?, ?, ?)");
                $stmt->execute(['about', 'about_carousel_img', $existing['about_carousel_img']]);
            }

            $success = "About content updated successfully.";
        }

        $stmt = $pdo->prepare("SELECT key, value FROM about WHERE section = 'about'");
        $stmt->execute();
        $aboutData = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $aboutData[$row['key']] = $row['value'];
        }

        // === Handle Blog Submission ===
        $editBlog = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !in_array($_POST['form_type'] ?? '', ['home_update', 'about_update'])) {
            if (isset($_POST['delete_id'])) {
                $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
                $stmt->execute([$_POST['delete_id']]);
                $success = "Article deleted.";
            } else {
                $id = $_POST['id'] ?? null;
                $title = $_POST['title'] ?? '';
                $author = $_POST['author'] ?? '';
                $content = $_POST['content'] ?? '';
                $is_featured = isset($_POST['is_featured']) ? 1 : 0;
                $image_path = null;

                if (!$title || !$author || !$content) {
                    $error = "Title, Author, and Content are required.";
                } else {
                    if (!empty($_FILES['image']['tmp_name'])) {
                        $uploadDir = "assets/upload/articles/";
                        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                        $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
                        $filePath = $uploadDir . $fileName;
                        if (move_uploaded_file($_FILES["image"]["tmp_name"], $filePath)) {
                            $image_path = $filePath;
                        }
                    }

                    if ($id) {
                        $query = "UPDATE articles SET title = ?, author = ?, content = ?, is_featured = ?";
                        $params = [$title, $author, $content, $is_featured];
                        if ($image_path) {
                            $query .= ", image_path = ?";
                            $params[] = $image_path;
                        }
                        $query .= " WHERE id = ?";
                        $params[] = $id;

                        $stmt = $pdo->prepare($query);
                        $stmt->execute($params);
                        $success = "Article updated.";
                    } else {
                        $stmt = $pdo->prepare("INSERT INTO articles (title, author, content, image_path, is_featured) VALUES (?, ?, ?, ?, ?)");
                        $stmt->execute([$title, $author, $content, $image_path, $is_featured]);
                        $success = "Article published.";
                    }
                }
            }
        }

        if (isset($_GET['edit'])) {
            $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
            $stmt->execute([$_GET['edit']]);
            $editBlog = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $stmt = $pdo->prepare("SELECT * FROM articles ORDER BY published_at DESC");
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view('website', [
            'articles' => $articles,
            'editBlog' => $editBlog,
            'homeData' => $homeData,
            'aboutData' => $aboutData,
            'success' => $success,
            'error' => $error
        ]);
    }
}
