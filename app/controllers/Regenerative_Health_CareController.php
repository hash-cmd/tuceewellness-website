<?php
namespace App\Controllers;

use Core\Controller;
use Core\Database;
use PDO;

class Regenerative_Health_CareController extends Controller
{
    public function index()
    {
        // $db = new Database();
        // $pdo = $db->connect();

        // // Fetch all home content
        // $stmt = $pdo->prepare("SELECT key, value FROM home WHERE section = 'home'");
        // $stmt->execute();

        // $homeData = [];
        // foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
        //     $homeData[$row['key']] = $row['value'];
        // }

        $this->view('regenerative_health_care');
    }
}
