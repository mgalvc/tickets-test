<?php

$router->on("POST", "auth", function($body) {
    if(empty($body["login"])) {
        Router::send([
            "success" => false,
            "error" => "login must be provided"
        ]);
    }

    if(empty($body["password"])) {
        Router::send([
            "success" => false,
            "error" => "password must be provided"
        ]);
    }

    $auth = new Token();
    $token = $auth->generate_token($body["login"], $body["password"]);
    Router::send($token);
});

$router->on("DELETE", "auth", function($body) {
    if(empty($body["token"])) {
        Router::send([
            "success" => false,
            "error" => "token must be provided"
        ]);
    }

    $token = new Token();
    Router::send($token->remove($body["token"]));
});