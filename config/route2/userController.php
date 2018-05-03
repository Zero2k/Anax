<?php
/**
 * Routes for user controller.
 */
return [
    "routes" => [
        [
            "info" => "User Controller index.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["userController", "getIndex"],
        ],
        [
            "info" => "Login a user.",
            "requestMethod" => "get|post",
            "path" => "login",
            "callable" => ["userController", "getPostLogin"],
        ],
        [
            "info" => "Create a user.",
            "requestMethod" => "get|post",
            "path" => "create",
            "callable" => ["userController", "getPostCreateUser"],
        ],
        [
            "info" => "User profile.",
            "requestMethod" => "get",
            "path" => "profile",
            "callable" => ["userController", "viewUserProfile"],
        ],
        [
            "info" => "Update user.",
            "requestMethod" => "get|post",
            "path" => "update",
            "callable" => ["userController", "getUpdateUser"],
        ],
        [
            "info" => "Logout user.",
            "requestMethod" => "get|post",
            "path" => "logout",
            "callable" => ["userController", "logoutUser"],
        ],
    ]
];
