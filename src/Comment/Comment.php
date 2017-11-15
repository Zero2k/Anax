<?php

namespace Vibe\Comment;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;

/**
 * Comments.
 */
class Comment implements ConfigureInterface, InjectionAwareInterface
{
    use ConfigureTrait;
    use InjectionAwareTrait;

    /**
     * @var array $session inject a reference to the session.
     */
    private $session;
    
    
    /**
     * @var string $key to use when storing in session.
     */
    const KEY = "comments";


    /**
     * Inject dependencies.
     *
     * @param array $dependency key/value array with dependencies.
     *
     * @return self
     */
    public function inject($dependency)
    {
        $this->session = $dependency["session"];
        return $this;
    }


    /**
     * Get all comments saved in database.
     *
     * @return array with the dataset
     */
    public function viewComments()
    {
        $sql = "SELECT * FROM `comments`";
        $data = $this->di->get("database")->executeFetchAll($sql);
        return $data;
    }


    /**
     * Add new comment.
     *
     */
    public function addComment($email, $content, $name)
    {
        $sql = "INSERT INTO comments (email, text, postedBy) VALUES (?, ?, ?)";
        $data = $this->di->get("database")->execute($sql, [$email, $content, $name]);
        return $data;
    }


    /**
     * Remove comment.
     *
     * @param string $content, text
     *
     * @return array
     */
    /* public function removeComment($commentId)
    {

    } */
}
