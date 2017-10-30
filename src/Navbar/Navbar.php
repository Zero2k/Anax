<?php

namespace Anax\Navbar;

/**
* Navbar class.
*/
class Navbar implements
    \Anax\Common\ConfigureInterface,
    \Anax\Common\AppInjectableInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;

    public function renderNav()
    {
        $navbarData = $this->config;
        $menu = "";

        foreach ($navbarData as $key => $value) {
            foreach ($value as $key => $value) {
                $active = $this->app->request->getRoute() == $value ? "active" : "";
                if ($key == "text") {
                    $text = $value;
                } elseif ($key == "route") {
                    $url = $this->app->url->create($value);
                }
            }

            $menu .= "<li class='nav item $active'><a class='nav-link' href=$url>$text</a></li>";
        }

        return $menu;
    }
}
