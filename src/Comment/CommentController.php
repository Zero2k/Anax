<?php

namespace Vibe\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * A controller for the Comments.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class CommentController implements InjectionAwareInterface
{
    use InjectionAwareTrait;

    /**
     * @var string $path, path to comment module view files.
     */
    private $path = "../view/comments/";


    /**
     * Get all comments.
     *
     * @return void
     */
    public function viewComments()
    {
        $data = $this->di->get("comment")->viewComments();

        $this->di->get("view")->add($this->path . "comments", [
            "allComments" => $data
        ]);
        $this->di->get("pageRender")->renderPage([
            "title" => "Comments"
        ]);
    }

    /**
     * Post comments.
     *
     * @return void
     */
    public function addComment()
    {
        $postEmail = isset($_POST["email"]) ? htmlentities($_POST["email"]) : null;
        $postContent = isset($_POST["content"]) ? $_POST["content"] : null;
        $postName = isset($_POST["name"]) ? htmlentities($_POST["name"]) : null;

        if (!$postEmail) {
            $this->di->get("response")->redirect($this->di->get("url")->create("comments"));
        }

        $email = $postEmail;
        $content = $this->di->get("textfilter")->doFilter($postContent, "markdown");
        $name = !$postName ? "Anonymous" : $postName;

        $data = $this->di->get("comment")->addComment($email, $content, $name);
        if ($data) {
            $this->di->get("response")->redirect($this->di->get("url")->create("comments"));
        }
    }

    /**
     * Remove comments.
     *
     * @return void
     */
    /* public function removeComment($id)
    {
        
    } */
}
