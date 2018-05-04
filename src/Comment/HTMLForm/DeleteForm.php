<?php

namespace Anax\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\Comment\Comment;

/**
 * Form to delete an item.
 */
class DeleteForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $userId)
    {
        parent::__construct($di);
        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Delete an item",
            ],
            [
                "select" => [
                    "type"        => "select",
                    "label"       => "Select item to delete:",
                    "options"     => $this->getAllItems($userId),
                ],

                "submit" => [
                    "type" => "submit",
                    "value" => "Delete item",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get all items as array suitable for display in select option dropdown.
     *
     * @return array with key value of all items.
     */
    protected function getAllItems($userId)
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("database"));

        $comments = ["-1" => "Select an item..."];
        foreach ($comment->findAllWhere("userId = ?", $userId) as $obj) {
            $comments[$obj->id] = "{$obj->published} ({$obj->id})";
        }

        return $comments;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("database"));
        $comment->find("id", $this->form->value("select"));
        $comment->delete();

        $this->di->get("response")->redirect("comment");
    }
}
