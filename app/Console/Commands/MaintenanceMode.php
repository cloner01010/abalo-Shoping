<?php

namespace App\Console\Commands;

use App\Models\AbaloWebsocketClient;
use http\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Ratchet\Client\Connector;
use Ratchet\Client\WebSocket;
use React\EventLoop\Factory;
class MaintenanceMode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
      //  $loop = \React\EventLoop\Loop::get();
      //  $reactConnector = new \React\Socket\Connector(
      //      $loop,
      //      [
      //          'tls' => [
      //              'allow_self_signed' => true,
      //              'verify_peer' => false,
      //              'verify_peer_name' => false
      //          ]
      //      ]
      //  );
      //  $connector = new Connector($loop, $reactConnector);
      //  $connector(
      //      'ws://localhost:8888',
      //      [],
      //      ['Origin' => 'http://localhost']
      //  )->then(function($conn) {
      //      $conn->send(
      //          '{
      //              "from": "maintenanceMode",
      //              "message": "In Kürze verbessern wir Abalo für Sie!Nach einer kurzen Pause sind wir wieder für Sie da! Versprochen."
      //           }'
      //      );
      //      $conn->close();
      //  }, function ($e) {
      //      Log::info( "Could not connect: {$e->getMessage()}\n");
      //  });
      //  $loop->run();
        $webSocketClient= new AbaloWebsocketClient("In Kürze verbessern wir Abalo für Sie!Nach einer kurzen Pause sind wir wieder für Sie da! Versprochen.","MaintenanceMode");
        $webSocketClient->send();
        //Artisan::call('down');
        $this->info('Maintenance mode activated.');
    }
}
