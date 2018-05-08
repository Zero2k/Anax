<?php

namespace Anax\Admin;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Anax\Admin\HTMLForm\AdminLoginForm;
use \Anax\Admin\HTMLForm\AdminEditUserForm;
use \Anax\Admin\HTMLForm\AdminDeleteUserForm;
use \Anax\Admin\HTMLForm\AdminAddUserForm;
use \Anax\Admin\HTMLForm\AdminEditCommentForm;
use \Anax\Admin\HTMLForm\AdminDeleteCommentForm;
use \Anax\User\User;
use \Anax\Comment\Comment;

/**
 * A controller class.
 */
class AdminController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getIndex()
    {
        $title      = "A index page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "content" => "An index page",
        ];

        $view->add("admin/admin", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getPostLogin()
    {
        $title      = "A login page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new AdminLoginForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("admin/login", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getUsers()
    {
        $title      = "All users";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $users = new User();
        $users->setDb($this->di->get("database"));

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "users" => $users->findAll(),
        ];

        $view->add("admin/user/users", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function editUser($id)
    {
        $title      = "Edit user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $form       = new AdminEditUserForm($this->di, $id);

        $form->check();

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "content" => $form->getHTML(),
        ];

        $view->add("admin/user/edit", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function deleteUser($id)
    {
        $title      = "Delete user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $form       = new AdminDeleteUserForm($this->di, $id);

        $form->check();

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "content" => $form->getHTML(),
        ];

        $view->add("admin/user/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function addUser()
    {
        $title      = "Add user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $form       = new AdminAddUserForm($this->di);

        $form->check();

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "content" => $form->getHTML(),
        ];

        $view->add("admin/user/add", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getComments()
    {
        $title      = "All comments";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $comments = new Comment();
        $comments->setDb($this->di->get("database"));

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "comments" => $comments->findAll(),
        ];

        $view->add("admin/comment/comments", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function editComment($id)
    {
        $title      = "Edit comment";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $form       = new AdminEditCommentForm($this->di, $id);

        $form->check();

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "content" => $form->getHTML(),
        ];

        $view->add("admin/comment/edit", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function deleteComment($id)
    {
        $title      = "Delete comment";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $form       = new AdminDeleteCommentForm($this->di, $id);

        $form->check();

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "content" => $form->getHTML(),
        ];

        $view->add("admin/comment/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
