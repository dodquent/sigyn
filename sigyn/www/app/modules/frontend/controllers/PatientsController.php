<?php

namespace Sigyn\Modules\Frontend\Controllers;

use Sigyn\Models\Patients;

class PatientsController extends ControllerBase
{
    public function indexAction()
    {
        $pro_id = $this->session->get("auth")['id'];
        $this->view->patientsList = Patients::findByProId($pro_id);
    }

    public function createAction()
    {
        if ($this->request->isPost()) {
            $patient = new Patients();

            $patient->email = $this->request->getPost("email");
            $patient->firstname = $this->request->getPost("firstname");
            $patient->name = $this->request->getPost("lastname");
            $patient->pro_id = $this->session->get("auth")['id'];

            if ($patient->save() === false) {
                $messages = $patient->getMessages();
                foreach ($messages as $message) {
                    $this->flash->error($message);
                }
                return $this->dispatcher->forward(["controller" => "patients", "action" => "index",]);
            }

            // ENVOI DU MAIL
            $link = $this->request->getServerName() . "/patients/patientPassword/" . $patient->id;
            $mail = $this->mailer;
            $mail->Subject = "Sigyn - Account creation";
            $content = file_get_contents(APP_PATH . '/modules/frontend/mail/template_patientPassword.html');
            $mail->Body = str_replace('{link}', $link, $content);
            $mail->AddAddress($patient->email);

            if(!$mail->Send()) {
                $this->flash->error("Mailer Error: " . $mail->ErrorInfo);
                return $this->dispatcher->forward(["controller" => "patients", "action" => "index",]);
            }

            $this->flashSession->success("An email confirmation as been sent to $patient->email");
            return $this->response->redirect("patients");
        }
    }

    public function patientPasswordAction(int $id = null)
    {
        //POST
        if ($this->request->isPost()) {
            $patient = Patients::findFirstById($this->request->getPost("patient_id"));
            
            $patient->email = $this->request->getPost("email");
            $patient->firstname = $this->request->getPost("firstname");
            $patient->name = $this->request->getPost("lastname");
            
             if ($this->request->getPost("password") !== $this->request->getPost("confirmPassword")) {
                $this->flashSession->error("Passwords does not match.");

                return $this->response->redirect("patients/patientPassword/" . $patient->id);

            }
            //prevent hashing an empty password
            if (!empty($this->request->getPost("password"))) {
                $patient->password = $this->security->hash($this->request->getPost("password"));
            }

            if ($patient->save() === false) {
                $messages = $patient->getMessages();
                foreach ($messages as $message) {
                    $this->flash->error($message);
                }
                return $this->dispatcher->forward(["controller" => "patients", "action" => "patientPassword"]);
            }

            $this->flashSession->success("Congratulations ! Your account is now configured. You can start using Sigyn.");
            return $this->response->redirect("session");
        }

        //GET
        if ($this->session->get("auth")) {
            return $this->response->redirect("home");
        }
        $patient = Patients::findFirstById($id);
        if (!$patient) {
            return $this->dispatcher->forward(["controller" => "errors", "action" => "show404"]);
        }

        $this->view->patient = $patient;
    }
}

