<?php

namespace App\Controllers;

use Core\Controller;
use Core\Database;
use PDO;
use DateTime;
use DateInterval;

class LiveChatController extends Controller
{
    // Function to format the time as relative (e.g., "1 min ago", "2 days ago")
    private function formatRelativeTime($dateTime)
    {
        $currentTime = new DateTime();
        $diff = $currentTime->diff($dateTime);

        if ($diff->y > 0) {
            return $diff->y . ' year' . ($diff->y > 1 ? 's' : '') . ' ago';
        } elseif ($diff->m > 0) {
            return $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . ' ago';
        } elseif ($diff->d > 0) {
            return $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . ' ago';
        } elseif ($diff->h > 0) {
            return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
        } elseif ($diff->i > 0) {
            return $diff->i . ' minute' . ($diff->i > 1 ? 's' : '') . ' ago';
        } else {
            return $diff->s . ' second' . ($diff->s > 1 ? 's' : '') . ' ago';
        }
    }

    // Function to format the exact date if older than 1 month
    private function formatExactTime($dateTime)
    {
        return $dateTime->format('Y-m-d H:i'); // Format as "2023-06-14 15:30"
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: auth');
            exit;
        }

        $db = new Database();
        $conn = $db->connect();

        $error = null;
        $messages = [];
        $senders = [];
        $lastMessages = [];

        try {
            // Get list of unique senders (clients)
            $stmt = $conn->query("SELECT DISTINCT sender_name FROM live_chat WHERE sender_type = 'client'");
            $senders = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Get all messages and format the timestamp
            $stmt = $conn->query("SELECT sender_type, sender_name, message, recipient, created_at FROM live_chat ORDER BY id ASC");
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Loop through each message and format the time
            foreach ($messages as &$msg) {
                // Convert created_at to DateTime object
                $dateTime = new DateTime($msg['created_at']);
                $currentTime = new DateTime();

                // If the message is older than 1 month, show the exact date and time
                if ($dateTime->diff($currentTime)->m >= 1) {
                    $msg['formatted_time'] = $this->formatExactTime($dateTime);
                } else {
                    // Else show relative time
                    $msg['formatted_time'] = $this->formatRelativeTime($dateTime);
                }

                // Store the last message by sender (for preview)
                $lastMessages[$msg['sender_name']] = [
                    'message' => $msg['message'],
                    'formatted_time' => $msg['formatted_time']
                ];
            }
        } catch (\PDOException $e) {
            $error = 'Error fetching chat messages: ' . $e->getMessage();
        }

        // Pass variables to the view
        $this->view('livechat', [
            'senders' => $senders,
            'messages' => $messages,
            'lastMessages' => $lastMessages,
            'error' => $error
        ]);
    }
}
