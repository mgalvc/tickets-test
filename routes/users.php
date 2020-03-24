<?php

$router->on("GET", "users", function($body) {
    $users = new User();
    if(!empty($body["id"])) {
        Router::send($users->get($body["id"]));
    }
    Router::send($users->get());
});

$router->on("POST", "users", function($body) {
    $validation = User::validate($body);
    if(!empty($validation["success"])) {
        $user = new User($body);
        $response = $user->save();
        Router::send($response);
    } else {
        Router::send($validation);
    }
});

$router->on("PUT", "users", function() {
    echo "PUT request to users";
});

$router->on("DELETE", "users", function($body) {
    if(empty($body["id"])) {
        Router::send([
            "success" => false,
            "error" => "id must be provided"
        ]);
    }
    $user = new User();
    Router::send($user->remove($body["id"]));
});