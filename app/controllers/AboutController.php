<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;
use PDO;

class AboutController extends Controller
{
    public function index()
    {
        // Connect to database
        $db = new Database();
        $pdo = $db->connect();

        // Fetch all content for the "about" page
        $stmt = $pdo->prepare("SELECT key, value FROM about WHERE section = 'about'");
        $stmt->execute();

        $aboutData = [];
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            $aboutData[$row['key']] = $row['value'];
        }

        // Load the view with data
        $this->view('about', [
            'aboutData' => $aboutData
        ]);
    }
}
