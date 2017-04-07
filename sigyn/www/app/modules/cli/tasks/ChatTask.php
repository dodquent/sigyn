<?php
namespace Sigyn\Modules\Cli\Tasks;



class ChatTask extends \Phalcon\Cli\Task
{
    public function mainAction()
    {
        $websocketPort = 8088;

        $server = \Ratchet\Server\IoServer::factory(
            new \Ratchet\Http\HttpServer(
                new \Ratchet\WebSocket\WsServer(
                    new \Sigyn\Library\Chat()
                )
            ),
            $websocketPort
        );

        $server->run();
    }
}