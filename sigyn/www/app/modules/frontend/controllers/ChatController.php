<?php
namespace Sigyn\Modules\Frontend\Controllers;

class ChatController extends ControllerBase
{
    public function indexAction()
    {
        $websocketPort = 8088;
        $httpHost = $this->request->getServer('HTTP_HOST');

        // You may need to change the domain name and host
        // port depending upon the system.
        $this->view->setVars([
            'HTTP_HOST'      => $httpHost,
            'WEBSOCKET_PORT' => $websocketPort,
        ]);
    }

    public function saveMessage($msg)
    {

    }
}