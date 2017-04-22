<?php

namespace Sigyn\Modules\Frontend\Controllers;

use Sigyn\Models\Pros;

class RegisterController extends ControllerBase
{

    public function indexAction()
    {
    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            $pro = new Pros();

            $pro->email = $this->request->getPost("email");
            $pro->pro_type = $this->request->getPost("pro_type");

            if ($this->request->getPost("password") !== $this->request->getPost("confirmPassword")) {
                $this->flash->error("Passwords does not match.");
                return $this->dispatcher->forward(["controller" => "register", "action" => "index",]);
            }
            //prevent hashing an empty password
            if (!empty($this->request->getPost("password"))) {
                $pro->password = $this->security->hash($this->request->getPost("password"));
            }

            if ($pro->save() === false) {
                $messages = $pro->getMessages();
                foreach ($messages as $message) {
                    $this->flash->error($message);
                }
                return $this->dispatcher->forward(["controller" => "register", "action" => "index",]);
            }

            // ENVOI DU MAIL
            $link = $this->request->getServerName() . "/account/mailVerification/" . $pro->id;
            $mail = $this->mailer;
            $mail->Subject = "Sigyn - Account confirmation";
            $content = file_get_contents(APP_PATH . '/modules/frontend/mail/template_accountConfirmation.html');
            $mail->Body = str_replace('{link}', $link, $content);
            $mail->AddAddress($pro->email);

            if(!$mail->Send()) {
                $this->flash->error("Mailer Error: " . $mail->ErrorInfo);
                return $this->dispatcher->forward(["controller" => "register", "action" => "index",]);
            }

            $this->flashSession->success("An email confirmation as been sent to $pro->email");
            return $this->response->redirect("session");
        }
    }
}
