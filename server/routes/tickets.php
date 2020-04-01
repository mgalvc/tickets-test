<?php

$router->on("GET", "tickets", function($body) {
    $tickets = new Ticket();
    if(!empty($body["id"])) {
        Router::send($tickets->get($body["id"]));
    }
    Router::send($tickets->get());
}, true);

$router->on("POST", "tickets", function($body) {
    $validation = Ticket::validate($body);
    if(!empty($validation["success"])) {
        $ticket = new Ticket($body);
        $response = $ticket->save();
        Router::send($response);
    } else {
        Router::send($validation);
    }
}, true);

$router->on("PUT", "tickets", function($body) {
    if(empty($body["id"])) {
        Router::send([
            "success" => false,
            "error" => "id must be provided"
        ]);
    }

    if(empty($body["data"])) {
        Router::send([
            "success" => false,
            "error" => "data must be provided"
        ]);
    }

    $ticket = new Ticket();
    Router::send($ticket->edit($body["id"], $body["data"]));
}, true);

$router->on("DELETE", "tickets", function($body) {
    if(empty($body["id"])) {
        Router::send([
            "success" => false,
            "error" => "id must be provided"
        ]);
    }

    $ticket = new Ticket();
    Router::send($ticket->remove($body["id"]));
}, true);