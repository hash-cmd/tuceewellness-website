<?php
namespace App\Controllers;

use Core\Controller;
use Core\Database;
use PDO;

class BlogController extends Controller
{
    public function index()
    {
        $db = new Database();
        $pdo = $db->connect();
        $stmt = $pdo->query("SELECT * FROM articles ORDER BY published_at DESC");
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->view('blog', ['articles' => $articles]);
    }

    public function show($id)
    {
        $db = new Database();
        $pdo = $db->connect();
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$article) {
            die("Article not found.");
        }

        $this->view('detail', ['article' => $article]);
    }

    // New method for AJAX
    public function fetch($id)
    {
        $db = new Database();
        $pdo = $db->connect();
        $stmt = $pdo->prepare("SELECT * FROM articles WHERE id = ?");
        $stmt->execute([$id]);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$article) {
            http_response_code(404);
            echo json_encode(['error' => 'Article not found']);
            return;
        }

        // Return just the main article HTML
        ob_start();
        include __DIR__ . '/../Views/partials/main_article.php';
        $html = ob_get_clean();

        echo json_encode(['html' => $html]);
    }
}
