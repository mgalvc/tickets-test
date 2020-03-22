<?php

$router->on("GET", "users", function() {
    echo "GET request to users";
});

$router->on("POST", "users", function() {
    echo "POST request to users";
});

$router->on("PUT", "users", function() {
    echo "PUT request to users";
});

$router->on("DELETE", "users", function() {
    echo "DELETE request to users";
});