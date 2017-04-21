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

            $newToken = RecoveryToken::findFirstByUserId($user->id);
            if ($newToken) {
                $newToken->delete();
            }

            $newToken = new RecoveryToken();
            $newToken->user_id = $user->id;

            if ($newToken->save() === false) {
                $this->flash->error("An error has occured. Please try again later.");
                return $this->dispatcher->forward(["controller" => "session", "action" => "index",]);
            }
            $link = $this->request->getServerName() . "/account/passwordChange/" . $newToken->id;

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
            
            $this->flashSession->success("An email as been sent to $email");
        }
        return $this->response->redirect("index");
    }



    public function passwordChangeAction(string $id = null)
    {
        //on POST
        if ($this->request->isPost()) {
            $token = $this->request->getPost("token");
            $user = Users::findFirstById($id);

            if ($this->request->getPost("password") !== $this->request->getPost("confirmPassword")) {
                $this->flashSession->error("Passwords does not match.");
                return $this->response->redirect("account/passwordChange/$token");
            }
            //prevent hashing an empty password
            if (!empty($this->request->getPost("password"))) {
                $user->password = $this->security->hash($this->request->getPost("password"));
            }

            if ($user->save() === false) {
                $messages = $user->getMessages();

                foreach ($messages as $message) {
                    $this->flashSession->error($message);
                }
                return $this->response->redirect("account/passwordChange/$token");
            }
            $this->flashSession->success("Your password has been successfully updated. You can now login.");
            return $this->response->redirect("index");
        }

        //on GET
        $token = RecoveryToken::findFirstById($id);
        if (!$token) {
            return $this->dispatcher->forward(["controller" => "errors", "action" => "show404",]);
        }
        //check token time
        if (time() > $token->expiration_date) {
            $this->flash->error("Your link has expired.");
            return $this->dispatcher->forward(["controller" => "session", "action" => "index",]);
        }
        $this->view->user = $token->Users;
        $this->view->token = $token->id;
    }



    public function mailVerificationAction()
    {
        /*
        TODO
        */
    }

}
