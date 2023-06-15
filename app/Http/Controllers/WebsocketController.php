<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ratchet\ConnectionInterface;

class WebsocketController extends Controller implements \Ratchet\MessageComponentInterface
{
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
       // $queryParams = $conn->httpRequest->getUri()->getQuery();
       // parse_str($queryParams, $queryData);
      // // $userId = $queryData['user_id'];
      //  $queryParameters = $conn->WebSocket->request->getQuery();
      //parse_str($queryParameters, $queryParams);
        $conn->resourceId = $__GET['user_id']?? $conn->resourceId;

        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
           // if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            //}
        }
    }

    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        Log::info( "Connection {$conn->resourceId} has disconnected\n");
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        Log::info( "An error has occurred: {$e->getMessage()}\n");

        $conn->close();
    }
}
