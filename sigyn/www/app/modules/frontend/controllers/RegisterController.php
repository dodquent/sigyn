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

            if ($this->request->getPost("password") !== $this->request->getPost("confirmPassword")) {
                $this->flash->error("Passwords does not match.");
                return $this->dispatcher->forward(
                    [
                        "controller" => "register",
                        "action"     => "index",
                    ]
                );
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

                return $this->dispatcher->forward(
                    [
                        "controller" => "register",
                        "action"     => "index",
                    ]
                );
            }

            // Forward to the 'home' controller if the pro is valid
            return $this->dispatcher->forward(
                [
                    "controller" => "session",
                    "action"     => "login",
                ]
            );
        }
    }
}
