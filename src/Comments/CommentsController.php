<?php

namespace Vibe\Comments;

use \Anax\Common\AppInjectableInterface;
use \Anax\Common\AppInjectableTrait;

/**
 * A controller for the Comments.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class CommentsController implements AppInjectableInterface
{
    use AppInjectableTrait;

    /**
     * @var string $path, path to comment module view files.
     */
    private $path = "../view/comments/";


    /**
     * Get all comments.
     *
     * @return void
     */
    public function getComments()
    {
        $allComments = $this->app->comments->getComments();

        $this->app->view->add($this->path . "comments", [
            "allComments" => $allComments
        ]);
        $this->app->renderPage([
            "title" => "Comments"
        ]);
    }

    /**
     * Post comments.
     *
     * @return void
     */
    public function postComments($content, $name, $email)
    {

        if (!$email) {
            $this->app->redirect("comments");
        }

        $content = $this->app->textfilter->doFilter($content, "markdown");
        $name = !$name ? "Anonymous" : htmlentities($name);
        $email = htmlentities($email);

        $this->app->comments->postComments($content, $name, $email);
        $this->app->redirect("comments");
    }

    /**
     * Remove comments.
     *
     * @return void
     */
    public function removeComments($id)
    {
        $this->app->comments->removeComments($id);
        $this->app->redirect("comments");
    }
}
