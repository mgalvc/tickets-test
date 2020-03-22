<?php

$router->on("GET", "tickets", function() {
    echo "GET request to tickets";
});

$router->on("POST", "tickets", function() {
    echo "POST request to tickets";
});

$router->on("PUT", "tickets", function() {
    echo "PUT request to tickets";
});

$router->on("DELETE", "tickets", function() {
    echo "DELETE request to tickets";
});