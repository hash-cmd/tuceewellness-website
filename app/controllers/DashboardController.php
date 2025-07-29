<?php

namespace App\Controllers;

use Core\Controller;

class DashboardController extends Controller {
    public function index() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Optional: Auto logout after inactivity
        $timeout = 1800; // 30 minutes
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
            session_unset();
            session_destroy();
            header('Location: /tucee/auth');
            exit;
        }
        $_SESSION['last_activity'] = time();

        // Require login
        if (!isset($_SESSION['user'])) {
            $_SESSION['redirect_after_login'] = 'tucee/dashboard';
            header('Location: /tucee/auth');
            exit;
        }

        $this->view('dashboard', [
            'user' => $_SESSION['user']
        ]);
    }
}
