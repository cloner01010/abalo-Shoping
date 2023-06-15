<?php

namespace App\Models;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Ratchet\Client\Connector;

class AbaloWebsocketClient
{
    public $message;
    public $from;
    public $to;
    private $payload;
    public function __construct($message,$from,$to='everyone'){
        $this->from = $from;
        $this->message = $message;
        $this->to=$to;
        $this->payload=[
            "from" => $this->from,
            "message"=>$this->message,
            "to"=>$this->to,
        ];
    }
    public function send(){
        $loop = \React\EventLoop\Loop::get();
        $reactConnector = new \React\Socket\Connector(
            $loop,
            [
                'tls' => [
                    'allow_self_signed' => true,
                    'verify_peer' => false,
                    'verify_peer_name' => false
                ]
            ]
        );
        $connector = new Connector($loop, $reactConnector);
        $connector(
            'ws://localhost:8888',
            [],
            ['Origin' => 'http://localhost']
        )->then(function($conn) {
            $conn->send(json_encode($this->payload));
            $conn->close();
        }, function ($e) {
            Log::info( "Could not connect: {$e->getMessage()}\n");
        });
        $loop->run();
    }
}
