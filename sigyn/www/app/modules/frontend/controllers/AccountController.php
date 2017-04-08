<?php

namespace Sigyn\Modules\Frontend\Controllers;

use Phalcon\Mvc\Url;

class AccountController extends ControllerBase
{
    public function forgottenPasswordAction()
    {
        if ($this->request->isPost())
        {
            $email = strtolower($this->request->getPost("emailRecovery"));
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
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            $link = $this->request->getServerName() . "/account/validToken/$token";

            // ENVOI DU MAIL
            $mail = $this->mailer;
            $mail->Subject = "Test";
            $content = file_get_contents(APP_PATH . '/modules/frontend/mail/template_forgottenPassword.html');
            $mail->Body = str_replace('{link}', $link, $content);
            $mail->AddAddress($email);

            if(!$mail->Send()) {
                $this->flash->error("Mailer Error: " . $mail->ErrorInfo);
                return $this->dispatcher->forward(
                    [
                        "controller" => "session",
                        "action"     => "index",
                    ]
                );
            }
            
            $this->flashSession->notice("An email as been sent to $email");
        }
        return $this->response->redirect("index");
    }

    public function validTokenAction($token)
    {
        var_dump($token);die;
    }   

}
