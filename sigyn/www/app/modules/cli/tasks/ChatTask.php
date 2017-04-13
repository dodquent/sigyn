<?php
namespace Sigyn\Modules\Cli\Tasks;
use \Phalcon\Cli\Task;
use \Ratchet\Server\IoServer;
use \Ratchet\Http\HttpServer;
use \Ratchet\WebSocket\WsServer;
use \Sigyn\Library\Chat;



class ChatTask extends Task
{
    public function mainAction()
    {
        $websocketPort = 8088;

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            $websocketPort
        );

        $server->run();
    }
}