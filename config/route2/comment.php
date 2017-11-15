<?php
/**
 * Routes for Comments.
 */
 
return [
    "routes" => [
        [
            "info" => "View comments",
            "requestMethod" => "get",
            "path" => "",
            "callable" => ["commentController", "viewComments"]
        ],
        [
            "info" => "Post new comment",
            "requestMethod" => "post",
            "path" => "add",
            "callable" => ["commentController", "addComment"]
        ],
    ]
];
