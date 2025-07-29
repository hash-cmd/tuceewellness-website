<?php

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

class DB {
    public static function connect() {
        $dsn = "pgsql:host=localhost;port=5432;dbname=tucee_wellness_website;user=postgres;password=....";
        return new PDO($dsn);
    }
}

class ChatServer implements MessageComponentInterface {
    protected $clients = [];

    public function onOpen(ConnectionInterface $conn) {
        $this->clients[$conn->resourceId] = ['conn' => $conn, 'type' => null, 'name' => null];
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $data = json_decode($msg, true);
        if (!$data) return;

        $this->clients[$from->resourceId]['type'] = $data['sender_type'];
        $this->clients[$from->resourceId]['name'] = $data['sender_name'];

        try {
            $pdo = DB::connect();
            $stmt = $pdo->prepare("INSERT INTO live_chat (sender_type, sender_name, message, recipient, created_at)
                                   VALUES (:type, :name, :message, :recipient, :created_at)");
            $stmt->execute([
                ':type' => $data['sender_type'],
                ':name' => $data['sender_name'],
                ':message' => $data['message'],
                ':recipient' => $data['recipient'] ?? null,
                ':created_at' => $data['created_at']
            ]);
        } catch (\Exception $e) {
            echo "DB Error: " . $e->getMessage() . "\n";
        }

        foreach ($this->clients as $clientId => $clientData) {
            if ($from !== $clientData['conn']) {
                $clientData['conn']->send(json_encode([
                    'sender_type' => $data['sender_type'],
                    'sender_name' => $data['sender_name'],
                    'message' => $data['message'],
                    'recipient' => $data['recipient'] ?? null,
                    'created_at' => $data['created_at']  // Send the timestamp
                ]));
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        unset($this->clients[$conn->resourceId]);
        echo "Connection {$conn->resourceId} closed\n";
    }

    public function onError(ConnectionInterface $conn, \Throwable $e) {
        echo "Error: {$e->getMessage()}\n";
        $conn->close();
    }
}

$server = \Ratchet\Server\IoServer::factory(
    new \Ratchet\Http\HttpServer(
        new \Ratchet\WebSocket\WsServer(new ChatServer())
    ),
    8080
);

$server->run();
?>
