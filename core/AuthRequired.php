<?php

function authRequired() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user'])) {
        header('Location: /tucee/auth');
        exit;
    }
}
