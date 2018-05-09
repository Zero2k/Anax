<?php

namespace Anax\Comment\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Anax\Comment\Comment;

/**
 * Form to update an item.
 */
class UpdateForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id, $userId)
    {
        parent::__construct($di);
        $comment = $this->getItemDetails($id, $userId);

        /* If comment doesn't belong to user, redirect to all comments */
        if (!$comment) {
            $this->di->get("response")->redirect("comment");
        }

        $this->form->create(
            [
                "id" => __CLASS__,
                "legend" => "Update details of the item",
            ],
            [
                "id" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $comment->id,
                ],

                "text" => [
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $comment->text,
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
     * @return Comment
     */
    public function getItemDetails($id, $userId)
    {
        $comment = new Comment();
        $comment->setDb($this->di->get("database"));
        $comment->find("id", $id);
        if ($comment->userId === $userId) {
            return $comment;
        }
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
        $comment->find("id", $this->form->value("id"));
        $comment->text = $this->form->value("text");
        $comment->save();
        $this->di->get("response")->redirect("comment");
    }
}
