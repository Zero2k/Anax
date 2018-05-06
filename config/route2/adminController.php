<?php
/**
 * Routes for admin controller.
 */
return [
    "routes" => [
        [
            "info" => "Admin Controller index.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["adminController", "getIndex"],
        ],
        [
            "info" => "Login a admin.",
            "requestMethod" => "get|post",
            "path" => "login",
            "callable" => ["adminController", "getPostLogin"],
        ],
        [
            "info" => "View users.",
            "requestMethod" => "get|post",
            "path" => "users",
            "callable" => ["adminController", "getUsers"],
        ],
        [
            "info" => "Edit user.",
            "requestMethod" => "get|post",
            "path" => "edit/{id:digit}",
            "callable" => ["adminController", "editUser"],
        ],
        [
            "info" => "Edit user.",
            "requestMethod" => "get|post",
            "path" => "delete/{id:digit}",
            "callable" => ["adminController", "deleteUser"],
        ],
        [
            "info" => "Add user.",
            "requestMethod" => "get|post",
            "path" => "add",
            "callable" => ["adminController", "addUser"],
        ],
    ]
];
