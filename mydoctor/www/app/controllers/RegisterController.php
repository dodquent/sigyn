<?php

class RegisterController extends ControllerBase
{

    public function indexAction()
    {
    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            $user = new User();

            $user->email = $this->request->getPost("email");

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
                $user->password = $this->security->hash($this->request->getPost("password"));
            }

            if ($user->save() === false) {
                $messages = $user->getMessages();

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

            // Forward to the 'home' controller if the user is valid
            return $this->dispatcher->forward(
                [
                    "controller" => "session",
                    "action"     => "login",
                ]
            );
        }
    }
}
