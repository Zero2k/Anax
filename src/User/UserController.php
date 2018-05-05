<?php

namespace Anax\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Anax\User\HTMLForm\UserLoginForm;
use \Anax\User\HTMLForm\CreateUserForm;
use \Anax\User\HTMLForm\UpdateUserForm;
use \Anax\User\User;

/**
 * A controller class.
 */
class UserController implements
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
        $this->di->get("response")->redirect("user/profile");
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
        $form       = new UserLoginForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
            "createUser" => "create",
        ];

        $view->add("user/login", $data);

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
    public function getPostCreateUser()
    {
        $title      = "A create user page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateUserForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("user/create", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getUpdateUser()
    {
        $title      = "Update user";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");

        $form       = new UpdateUserForm($this->di, $session->get("userId"));

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("user/update", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function viewUserProfile()
    {
        $title      = "View user profile";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $session    = $this->di->get("session");

        $user = new User();
        $user->setDb($this->di->get("database"));
        $userData = $user->find("id", $session->get("userId"));

        $data = [
            "userExist" => $session->get("userId"),
            "profile" => $userData,
        ];

        $view->add("user/profile", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler user logout.
     *
     * @return void
     */
    public function logoutUser()
    {
        $this->di->get('session')->delete('userId');
        $this->di->get('session')->delete('username');
        $this->di->get('session')->delete('userEmail');
        $this->di->get('session')->delete('userAdmin');
        $this->di->get("response")->redirect("user/login");
    }
}
