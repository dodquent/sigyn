<?php

namespace Sigyn\Modules\Frontend\Controllers;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
        if ($this->session->get("auth")) {
            return $this->response->redirect("home");
        }
        return $this->dispatcher->forward(
            [
                "controller" => "session",
                "action"     => "index",
            ]
        );
    }

}

