<?php

namespace Sigyn\Modules\Frontend\Controllers;

use Sigyn\Models\Pros;

class SessionController extends ControllerBase
{

    public function indexAction()
    {
    }

    private function _registerSession($pro)
    {
        $this->session->set(
           "auth",
           [
               "id"   => $pro->id,
               "email" => $pro->email,
           ]
        );
    }

    /**
    * This action authenticate and logs a pro into the application
    */
    public function loginAction()
    {
        if ($this->request->isPost()) {
            $email    = $this->request->getPost("email");
            $password = $this->request->getPost("password");

            $pro = Pros::findFirstByEmail($email);
            if ($pro) {
                if ($this->security->checkHash($password, $pro->password)) {
                    $this->_registerSession($pro);
                    $this->flashSession->success("Welcome !");
                    return $this->response->redirect("home");
                }
            } else {
                // To protect against timing attacks. Regardless of whether a pro exists or not, the script will take roughly the same amount as it will always be computing a hash.
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
