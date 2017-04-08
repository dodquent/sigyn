<?php

namespace Sigyn\Modules\Frontend\Controllers;

use Sigyn\Models\Users;

class SessionController extends ControllerBase
{

    public function indexAction()
    {
    }

    private function _registerSession($user)
    {
        $this->session->set(
           "auth",
           [
               "id"   => $user->id,
               "email" => $user->email,
           ]
        );
    }

    /**
    * This action authenticate and logs a user into the application
    */
    public function loginAction()
    {
        if ($this->request->isPost()) {
            $email    = $this->request->getPost("email");
            $password = $this->request->getPost("password");

            $user = Users::findFirstByEmail($email);
            if ($user) {
                if ($this->security->checkHash($password, $user->password)) {
                    $this->_registerSession($user);
                    $this->flashSession->success("Welcome !");
                    return $this->response->redirect("home");
                }
            } else {
                // To protect against timing attacks. Regardless of whether a user exists or not, the script will take roughly the same amount as it will always be computing a hash.
                $this->security->hash(rand());
            }
            $this->flash->error("Wrong email/password");
        }

        if ($this->session->get("auth")) {
            return $this->dispatcher->forward(
               [
                   "controller" => "home",
                   "action"     => "index",
               ]
            );
        }
        // Forward to the login form again
        return $this->dispatcher->forward(
           [
               "controller" => "session",
               "action"     => "index",
           ]
        );
    }

    /**
    * Finishes the active session redirecting to the index
    *
    * @return unknown
    */
    public function logoutAction()
    {
        $this->session->remove('auth');
        $this->flashSession->success('Goodbye!');
        return $this->response->redirect("session");
    }
}
