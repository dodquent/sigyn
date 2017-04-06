<?php

namespace Sigyn\Modules\Frontend\Controllers;

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function initialize()
    {
        $this->view->page = $this->dispatcher->getControllerName();
        if ($this->session->get("auth")) {
            $this->view->setTemplateAfter("user");
            $this->view->user = (object)$this->session->get("auth");
        } else {
            $this->view->setTemplateAfter("guest");
        }
    }
}
