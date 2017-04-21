<?php

namespace Sigyn\Modules\Frontend\Controllers;

use Sigyn\Models\Users;

class RegisterController extends ControllerBase
{

    public function indexAction()
    {
    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            $user = new Users();

            $user->email = $this->request->getPost("email");
            $user->pro_type = $this->request->getPost("pro_type");
            $user->type = $this->request->getPost("type");

            if ($this->request->getPost("password") !== $this->request->getPost("confirmPassword")) {
                $this->flash->error("Passwords does not match.");
                return $this->dispatcher->forward(["controller" => "register", "action" => "index",]);
            }
            //prevent hashing an empty password
            if (!empty($this->request->getPost("password"))) {
                $user->password = $this->security->hash($this->request->getPost("password"));
            }

            if ($user->save() === false) {
                $messages = $user->getMessages();
                foreach ($messages as $message) {
                    $this->flash->error($message);
                }
                return $this->dispatcher->forward(["controller" => "register", "action" => "index",]);
            }

            // ENVOI DU MAIL
            $link = $this->request->getServerName() . "/account/mailVerification/" . $user->id;
            $mail = $this->mailer;
            $mail->Subject = "Sigyn - Account confirmation";
            $content = file_get_contents(APP_PATH . '/modules/frontend/mail/template_accountConfirmation.html');
            $mail->Body = str_replace('{link}', $link, $content);
            $mail->AddAddress($user->email);

            if(!$mail->Send()) {
                $this->flash->error("Mailer Error: " . $mail->ErrorInfo);
                return $this->dispatcher->forward(["controller" => "register", "action" => "index",]);
            }

            $this->flashSession->success("An email confirmation as been sent to $user->email");
            return $this->response->redirect("session");
        }
    }
}
