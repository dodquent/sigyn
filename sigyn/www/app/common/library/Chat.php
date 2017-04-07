<?php
namespace Sigyn\Library;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);

        echo "New connection!";

        foreach ($this->clients as $client) {
            if ($conn !== $client) {
                // Send connection message to all clients but the current one
                $client->send("Client {$client->resourceId} connected.");
            }
        }
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Send to all clients but the current one
        foreach ($this->clients as $client) {
            if ($from != $client) {
                $msg = "Client {$client->resourceId} says \"$msg\"";
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        $conn->close();
    }
}
