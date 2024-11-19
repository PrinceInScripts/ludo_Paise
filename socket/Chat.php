<?php
namespace MyApp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require dirname(__DIR__) . '/vendor/autoload.php';

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo "Received message: $msg\n";

    $data = json_decode($msg, true);

    if (!isset($data['action'])) {
        $from->send(json_encode(['error' => 'No action specified']));
        return;
    }

    switch ($data['action']) {
        case 'fetch_active_room':
            echo "Fetching active room\n";
            break;

        case 'submit_room_code':
            if (isset($data['room_code'])) {
                echo "Submitting room code: {$data['room_code']}\n";
            } else {
                $from->send(json_encode(['error' => 'Room code not provided']));
            }
            break;

        case 'wait_for_room_code':
                // $this->waitForRoomCode($from, $data['battle']);
                $newRoomCode = '123456'; // Replace with dynamic fetch logic
                $from->send(json_encode(['action' => 'update_room_code', 'room_code' => $newRoomCode]));
                break;

        default:
            $from->send(json_encode(['error' => 'Invalid action']));
    }
    }

    private function waitForRoomCode(ConnectionInterface $conn, $battle) {
        // Watch database or trigger updates (e.g., polling or event-based)
        // Example: When a new room code is saved:
        $newRoomCode = '123456'; // Replace with dynamic fetch logic
        $conn->send(json_encode(['action' => 'update_room_code', 'room_code' => $newRoomCode]));
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }
}