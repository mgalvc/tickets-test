<?php

$router->on("GET", "users", function() {
    echo "GET request to users";
});

$router->on("POST", "users", function($body) {
    $validation = User::validate($body);
    if(!empty($validation["success"])) {
        $user = new User($body);
        $user->save();
    } else {
        Router::send($validation);
    }
});

$router->on("PUT", "users", function() {
    echo "PUT request to users";
});

$router->on("DELETE", "users", function() {
    echo "DELETE request to users";
});