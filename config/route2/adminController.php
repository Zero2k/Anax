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
            "path" => "users/edit/{id:digit}",
            "callable" => ["adminController", "editUser"],
        ],
        [
            "info" => "Delete user.",
            "requestMethod" => "get|post",
            "path" => "users/delete/{id:digit}",
            "callable" => ["adminController", "deleteUser"],
        ],
        [
            "info" => "Add user.",
            "requestMethod" => "get|post",
            "path" => "users/add",
            "callable" => ["adminController", "addUser"],
        ],
        [
            "info" => "View comments.",
            "requestMethod" => "get|post",
            "path" => "comments",
            "callable" => ["adminController", "getComments"],
        ],
        [
            "info" => "Edit comment.",
            "requestMethod" => "get|post",
            "path" => "comments/edit/{id:digit}",
            "callable" => ["adminController", "editComment"],
        ],
        [
            "info" => "Delete comments.",
            "requestMethod" => "get|post",
            "path" => "comments/delete/{id:digit}",
            "callable" => ["adminController", "deleteComment"],
        ],
    ]
];
