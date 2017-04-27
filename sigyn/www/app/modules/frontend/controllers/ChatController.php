<?php
namespace Sigyn\Modules\Frontend\Controllers;
use Sigyn\Models\Messages;
use Sigyn\Models\Pros;
use Sigyn\Models\Patients;

class ChatController extends ControllerBase
{
    public function indexAction()
    {
        $websocketPort = 8088;
        $httpHost = $this->request->getServer('HTTP_HOST');
        
        $pro_id = $this->session->get("auth")['id'];
        $patientList = Patients::findByProId($pro_id);
        $messages = Messages::findByIdPro($pro_id);
        // You may need to change the domain name and host
        // port depending upon the system.
        $this->view->setVars([
            'HTTP_HOST'      => $httpHost,
            'WEBSOCKET_PORT' => $websocketPort,
            'PATIENTS'       => $patientList,
            'MESSAGES'       => $messages,
        ]);

        $this->assets->addJs("js/chat.js");
    }

    public function sendMessageAction()
    {
        $pro = $this->session->get("auth");
        $message = new Messages();
        var_dump($message);
        die();

        $message->test = $this->request->getPost("message");
        $message->id_sender = $pro["id"];
        $message->id_receiver = $this->request->getPost("receiver");
        $is_pro = $message->users->type;
        if ($message->save() === false) {
                die();
                foreach ($errors as $error) {
                    $this->flash->error($error);
                }
        }

        return $this->response->setJsonContent("ok");
    }
}