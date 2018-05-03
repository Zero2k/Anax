<?php

namespace Anax\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\User\User;

/**
 * Example of FormModel implementation.
 */
class CreateUserForm extends FormModel
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
                /* "legend" => "Create user", */
            ],
            [
                "acronym" => [
                    "type"        => "text",
                ],

                "email" => [
                    "type"        => "text",
                ],
        
                "password" => [
                    "type"        => "password",
                ],
        
                "password-again" => [
                    "type"        => "password",
                    "validation" => [
                        "match" => "password"
                    ],
                ],
        
                "submit" => [
                    "type" => "submit",
                    "value" => "Create user",
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
        $acronym       = $this->form->value("acronym");
        $email         = $this->form->value("email");
        $password      = $this->form->value("password");
        $passwordAgain = $this->form->value("password-again");
    
        // Check password matches
        if ($password !== $passwordAgain ) {
            $this->form->rememberValues();
            $this->form->addOutput("Password did not match.");
            return false;
        }
    
        // Save to database #1
        /* $db = $this->di->get("database");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $db->connect()
           ->insert("User", ["acronym", "password"])
           ->execute([$acronym, $password]); */

        // Save to database #2
        $user = new User();
        $user->setDb($this->di->get("database"));
        $user->acronym = $acronym;
        $user->email = $email;
        $user->setPassword($password);
        $user->save();
    
        $this->form->addOutput("User was created.");
        return true;
    }    
}