<?php

namespace Anax\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\User\User;

/**
 * Example of FormModel implementation.
 */
class UserLoginForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di)
    {
        parent::__construct($di);

        $this->form->create(
            [
                "id" => __CLASS__
                /* "legend" => "User Login" */
            ],
            [
                "user" => [
                    "type"        => "text",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],
                        
                "password" => [
                    "type"        => "password",
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Login",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        // Get values from the submitted form
        $acronym       = $this->form->value("user");
        $password      = $this->form->value("password");
    
        // Try to login #1
        /* $db = $this->di->get("database");
        $db->connect();
        $user = $db->select("password")
                   ->from("User")
                   ->where("acronym = ?")
                   ->executeFetch([$acronym]);
    
        // $user is false if user is not found
        if (!$user || !password_verify($password, $user->password)) {
           $this->form->rememberValues();
           $this->form->addOutput("User or password did not match.");
           return false;
        } */

        // Try to login #2
        $user = new User();
        $user->setDb($this->di->get("database"));
        $res = $user->verifyPassword($acronym, $password);

        if (!$res) {
            $this->form->rememberValues();
            $this->form->addOutput("User or password did not match.");
            return false;
        }

        $session = $this->di->get("session");
        $session->set("username", $user->acronym);
        $session->set("userId", $user->id);
        $session->set("userEmail", $user->email);

        $this->di->get("response")->redirect("user/profile");
        /* $this->form->addOutput("User " . $user->acronym . " logged in."); */
        return true;
    }
}
