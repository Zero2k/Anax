<?php

namespace Anax\Admin\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\User\User;

/**
 * Form to update an item.
 */
class AdminDeleteForm extends FormModel
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
                    "validation" => null,
                    "readonly" => true,
                    "value" => $user->id,
                ],

                "acronym" => [
                    "type" => "text",
                    "validation" => null,
                    "readonly" => true,
                    "value" => $user->acronym,
                ],

                "email" => [
                    "type" => "text",
                    "validation" => null,
                    "readonly" => true,
                    "value" => $user->email,
                ],

                "admin" => [
                    "type" => "text",
                    "validation" => null,
                    "readonly" => true,
                    "value" => $user->admin,
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Delete",
                    "callback" => [$this, "callbackSubmit"]
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
        $id = $this->form->value("id");

        $user = new User();
        $user->setDb($this->di->get("database"));
        $user->find("id", $id);

        if ($user->id == $this->di->get("session")->get("userId")) {
            $this->form->addOutput("You can't delete yourself.", "fail");
            return false;
        }
        
        $user->delete();
        $this->di->get("response")->redirect("admin/users");
    }
}
