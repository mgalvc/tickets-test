<?php

class Router {
    public function on($type, $resource, $execute) {
        if($_SERVER["REQUEST_METHOD"] == $type) {
            $requestedRoute = $_REQUEST["r"];

            if($requestedRoute == $resource) {
                $execute();
            }
        }
    }
}