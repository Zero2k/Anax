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
    ]
];
