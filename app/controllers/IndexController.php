<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        return $this->dispatcher->forward(
               [
                   "controller" => "session",
                   "action"     => "index",
               ]
            );
    }

}

