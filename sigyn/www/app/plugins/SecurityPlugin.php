<?php
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
class SecurityPlugin extends Plugin
{
    private function getAcl()
    {
        // Create the ACL
        $acl = new AclList();
        // The default action is DENY access
        $acl->setDefaultAction(
            Acl::DENY
        );
        // Register two roles, Users is registered users
        // and guests are users without a defined identity
        $roles = [
            "users"  => new Role("Users"),
            "guests" => new Role("Guests"),
        ];
        foreach ($roles as $role) {
            $acl->addRole($role);
        }
        // Private area resources (backend)
        $privateResources = [
            "home"          => ["index"],
            "message"       => ["index"],
            "patients"      => ["index", "create"]
        ];
        foreach ($privateResources as $resourceName => $actions) {
            $acl->addResource(
                new Resource($resourceName),
                $actions
            );
        }
        // Public area resources (frontend)
        $publicResources = [
            "errors"        => ["show404", "show500"],
            "index"         => ["index"],
            "register"      => ["index", "create"],
            "session"       => ["index", "login", "logout"],
            "chat"          => ["index"],
            "account"       => ["forgottenPassword", "mailVerification", "passwordChange"],
            "patients"      => ["patientPassword"],
        ];
        foreach ($publicResources as $resourceName => $actions) {
            $acl->addResource(
                new Resource($resourceName),
                $actions
            );
        }
        // Grant access to public areas to both users and guests
        foreach ($roles as $role) {
            foreach ($publicResources as $resource => $actions) {
                $acl->allow(
                    $role->getName(),
                    $resource,
                    $actions
                );
            }
        }
        // Grant access to private area only to role Users
        foreach ($privateResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow(
                    "Users",
                    $resource,
                    $action
                );
            }
        }
        return $acl;
    }
    /**
     * Verify if the requested controller/action is authorized
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return void
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Check whether the "auth" variable exists in session to define the active role
        $auth = $this->session->get("auth");
        if (!$auth) {
            $role = "Guests";
        } else {
            $role = "Users";
        }
        // Take the active controller/action from the dispatcher
        $controller = $dispatcher->getControllerName();
        $action     = $dispatcher->getActionName();
        // Obtain the ACL list
        $acl = $this->getAcl();
        // Check if the Role have access to the controller (resource)
        $allowed = $acl->isAllowed($role, $controller, $action);
        if (!$allowed) {
            // If he doesn't have access forward him to the index controller
            $this->flash->error(
                "Please login."
            );
            $dispatcher->forward(
                [
                    "controller" => "session",
                    "action"     => "index",
                ]
            );
            // Returning "false" we tell to the dispatcher to stop the current operation
            return false;
        }
    }
}