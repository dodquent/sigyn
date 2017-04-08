<?php

namespace Sigyn\Modules\Frontend\Controllers;

use Sigyn\Models\Users;
use Sigyn\Models\RecoveryToken;

class AccountController extends ControllerBase
{
    public function forgottenPasswordAction()
    {
        if ($this->request->isPost())
        {
            $email = strtolower($this->request->getPost("emailRecovery"));
            if (empty($email)) {
                $this->flash->error("Please enter a valid email address");
                return $this->dispatcher->forward(["controller" => "session", "action" => "index",]);
            }

            $user = Users::findFirst(["email = :email:", "bind" => ["email" => $email]]);
            if (!$user) {
                $this->flash->error("This account does not exist.");
                return $this->dispatcher->forward(["controller" => "session", "action" => "index",]);
            }

            $newToken = new RecoveryToken();
            $link = $this->request->getServerName() . "/account/validToken/" . $newToken->id;

            // ENVOI DU MAIL
            $mail = $this->mailer;
            $mail->Subject = "Sigyn - Password change";
            $content = file_get_contents(APP_PATH . '/modules/frontend/mail/template_forgottenPassword.html');
            $mail->Body = str_replace('{link}', $link, $content);
            $mail->AddAddress($email);

            if(!$mail->Send()) {
                $this->flash->error("Mailer Error: " . $mail->ErrorInfo);
                return $this->dispatcher->forward(["controller" => "session", "action" => "index",]);
            }
            
            if ($newToken->save() === false) {
                $this->flash->error("An error has occured. Please try again later.");
                return $this->dispatcher->forward(["controller" => "session", "action" => "index",]);
            }
            
            $this->flashSession->notice("An email as been sent to $email");
        }
        return $this->response->redirect("index");
    }

    public function validTokenAction($token)
    {
        var_dump($token);die;
    }

    public function mailVerificationAction()
    {
        /*
        TODO
        */
    }

}
