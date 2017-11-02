<?php

namespace Vibe\Comments;

/**
 * Comments.
 */
class Comments
{
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
     * Save (the modified) dataset.
     *
     * @param string $dataset the data to save.
     *
     * @return self
     */
    public function saveDataset($dataset)
    {
        $this->session->set(self::KEY, $dataset);
        return $this;
    }


    /**
     * Get all comments saved in session.
     *
     * @return array with the dataset
     */
    public function getComments()
    {
        $data = $this->session->get(self::KEY);
        $set = isset($data)
            ? $data
            : [];
        return $set;
    }


    /**
     * Post new comment.
     *
     * @param string $content, text
     * @param string $name, name of user who posted comment
     * @param string $email, email to user who posted comment
     *
     * @return array
     */
    public function postComments($content, $name, $email)
    {
        $allComments = $this->session->get(self::KEY);

        $id = 0;
        foreach ($allComments as $value) {
            if ($id < $value["id"]) {
                $id = $value["id"];
            }
        }

        $comment = [
            "id" => ($id + 1),
            "content" => $content,
            "name" => $name,
            "email" => $email
        ];

        $allComments[] = $comment;

        $this->saveDataset($allComments);

        return $comment;
    }


    /**
     * Remove comment.
     *
     * @param string $content, text
     *
     * @return array
     */
    public function removeComments($commentId)
    {
        $allComments = $this->session->get(self::KEY);

        // Find the comment if id exists
        foreach ($allComments as $key => $value) {
            if ($value["id"] == $commentId) {
                unset($allComments[$key]);
            }
        }
        $this->saveDataset($allComments);
    }
}
