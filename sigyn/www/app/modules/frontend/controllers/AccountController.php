<?php

namespace Sigyn\Modules\Frontend\Controllers;

class AccountController extends ControllerBase
{
    public function forgottenPasswordAction()
    {
        var_dump($this->request->getPost("emailRecovery"));die;
        if ($this->request->isPost())
        {
            $email = $this->request->getPost("emailRecovery");
            if (empty($email))
            {
                $this->flash->error("Please enter a valid email address");
                return $this->dispatcher->forward(
                    [
                        "controller" => "session",
                        "action"     => "index",
                    ]
                );
            }
            // ENVOI DU MAIL
            
        }
        return $this->response->redirect("index");
    }

}
