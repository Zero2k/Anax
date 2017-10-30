<?php
/**
 * Routes to all pages.
 */
$app->router->add("test", function () use ($app) {
    $title = "Test route";
    $app->view->add("test/test", [
        "title" => $title,
        "message" => "You are not permitted to do this.",
    ]);
    $app->renderPage([
        "title" => $title,
    ]);
});
