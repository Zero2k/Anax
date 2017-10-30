<?php

namespace Anax\App;

/**
 * An App class to wrap the resources of the framework.
 *
 * @SuppressWarnings(PHPMD.ExitExpression)
 */
class App
{
    public function redirect($url)
    {
        $this->response->redirect($this->url->create($url));
        exit;
    }



    /**
     * Render a standard web page using a specific layout.
     */
    public function renderPage($data, $status = 200)
    {
        $data["stylesheets"] = ["https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css", "css/style.css"];
        
        // Add common header, navbar and footer
        // $this->view->add("layout/header", [], "header");
        $this->view->add("layout/navbar", [], "navbar");
        $this->view->add("layout/footer", [], "footer");

        // Add layout, render it, add to response and send.
        $this->view->add("layout/app", $data, "app");
        $body = $this->view->renderBuffered("app");
        $this->response->setBody($body)
                       ->send($status);
        exit;
    }
}
