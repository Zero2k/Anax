<?php

namespace Anax\Admin\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\User\User;

/**
 * Form to update an item.
 */
class AdminEditUserForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $user = $this->getItemDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                /* "legend" => "Update details of the item", */
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->id,
                ],

                "acronym" => [
                    "type" => "text",
                    "readonly" => true,
                    "validation" => ["not_empty"],
                    "value" => $user->acronym,
                ],

                "email" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->email,
                ],

                "admin" => [
                    "type" => "select",
                    "label" => "Set role - Admin?",
                    "options" => ["$user->admin" => $user->admin, "0" => "False", "1" => "True"]
                ],

                "password" => [
                    "type"        => "password",
                    "validation" => null,
                    "value" => null,
                ],

                "confirm-password" => [
                    "type"        => "password",
                    "validation" => null,
                    "value" => null,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],

                "reset" => [
                    "type"      => "reset",
                ],
            ]
        );
    }



    /**
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return User
     */
    public function getItemDetails($id)
    {
        $user = new User();
        $user->setDb($this->di->get("database"));
        $user->find("id", $id);
        return $user;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $user = new User();
        $user->setDb($this->di->get("database"));
        $user->find("id", $this->form->value("id"));

        $acronym = $this->form->value("acronym");
        $email = $this->form->value("email");
        $admin = $this->form->value("admin");
        $password = $this->form->value("password");
        $confirmPassword = $this->form->value("confirm-password");

        if (!$password) {
            $user->password = $user->password;
        } else {
            if ($password !== $confirmPassword) {
                $this->form->rememberValues();
                $this->form->addOutput("Password did not match.", "fail");
                return false;
            }

            $user->password = $password;
            $user->setPassword($password);
            $this->form->addOutput("Password has changed!", "success");
        }

        $user->acronym = $acronym;
        $user->email = $email;
        $user->admin = $admin;

        $user->save();
        $this->di->get("response")->redirect("admin/users");
    }
}
