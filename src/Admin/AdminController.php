<?php

namespace Anax\Admin;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Anax\Admin\HTMLForm\AdminLoginForm;
use \Anax\Admin\HTMLForm\AdminEditForm;
use \Anax\Admin\HTMLForm\AdminDeleteForm;
use \Anax\Admin\HTMLForm\AdminAddForm;
use \Anax\User\User;

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

        $view->add("admin/users", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function editUser($id)
    {
        $title      = "Edit user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $form       = new AdminEditForm($this->di, $id);

        $form->check();

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "content" => $form->getHTML(),
        ];

        $view->add("admin/edit", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function deleteUser($id)
    {
        $title      = "Delete user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $form       = new AdminDeleteForm($this->di, $id);

        $form->check();

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "content" => $form->getHTML(),
        ];

        $view->add("admin/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function addUser()
    {
        $title      = "Add user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");
        $form       = new AdminAddForm($this->di);

        $form->check();

        $data = [
            "userExist" => $session->get("userId"),
            "userAdmin" => $session->get("userAdmin"),
            "content" => $form->getHTML(),
        ];

        $view->add("admin/add", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
