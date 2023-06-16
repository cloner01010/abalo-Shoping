<?php

namespace App\Http\Controllers;

use http\Client;
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
        $queryParams = $conn->httpRequest->getUri()->getQuery();
        parse_str($queryParams, $queryData);

        $conn->resourceId = array_key_exists('user_id', $queryData) && !empty($queryData['user_id'])? $queryData['user_id']: $conn->resourceId;
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        $msg_json= json_decode($msg);
        switch ($msg_json->from){
            case 'sold':
                foreach ($this->clients as $client) {
                    if ($client->resourceId==$msg_json->to) {
                        Log::info($msg_json->message);
                        $client->send($msg);
                    }
                }
                break;
            case 'MaintenanceMode':
                foreach ($this->clients as $client) {
                    $client->send($msg);
                }
                break;
            case 'forSale':
                foreach ($this->clients as $client) {
                    if($from!=$client){
                        $client->send($msg);
                    }
                }
                break;
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
