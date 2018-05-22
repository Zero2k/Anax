<?php
/**
 * Routes for controller.
 */
return [
    "routes" => [
        [
            "info" => "Controller index.",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["commentController", "getIndex"],
        ],
        [
            "info" => "Create an item.",
            "requestMethod" => "get|post",
            "path" => "create",
            "callable" => ["commentController", "getPostCreateItem"],
        ],
        [
            "info" => "Delete an item.",
            "requestMethod" => "get|post",
            "path" => "delete",
            "callable" => ["commentController", "getPostDeleteItem"],
        ],
        [
            "info" => "Update an item.",
            "requestMethod" => "get|post",
            "path" => "update/{id:digit}",
            "callable" => ["commentController", "getPostUpdateItem"],
        ],
    ]
];
