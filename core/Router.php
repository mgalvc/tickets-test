<?php

class Router {
    public function on($type, $resource, $execute, $authenticable = false) {
        if($_SERVER["REQUEST_METHOD"] == $type) {
            $requestedRoute = $_REQUEST["r"];

            if($requestedRoute == $resource) {
                if($authenticable) {
                    $this->verify_token(getallheaders()["Authorization"]);
                }
                $body = json_decode(file_get_contents('php://input'), true);
                $headers = getallheaders();
                $execute($body, $headers);
            }
        }
    }

    public function verify_token($token) {
        $tokenHandler = new Token();
        if(empty($tokenHandler->find(["token" => $token]))) {
            Router::send(["success" => false, "error" => "unauthenticated"]);
        }
    }

    public static function send($body) {
        echo json_encode($body);
        die();
    }
}