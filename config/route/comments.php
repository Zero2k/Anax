<?php

$app->router->add("comments", function () use ($app) {
    $app->commentsController->getComments();
});

$app->router->add("comments/post", function () use ($app) {
    $app->commentsController->postComments($_POST["content"], $_POST["name"], $_POST["email"]);
});

$app->router->add("comments/remove", function () use ($app) {
    $app->commentsController->removeComments($_POST["id"]);
});
