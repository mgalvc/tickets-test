<?php

class Router {
    public function on($type, $resource, $execute) {
        if($_SERVER["REQUEST_METHOD"] == $type) {
            $requestedRoute = $_REQUEST["r"];

            if($requestedRoute == $resource) {
                $body = json_decode(file_get_contents('php://input'), true);
                $execute($body);
            }
        }
    }

    public static function send($body) {
        echo json_encode($body);
        die();
    }
}