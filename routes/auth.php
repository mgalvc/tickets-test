<?php

$router->on("POST", "auth", function() {
    echo "POST request to auth - login";
});

$router->on("DELETE", "auth", function() {
    echo "DELETE request to auth - logout";
});