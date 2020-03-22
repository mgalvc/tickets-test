<?php

require("core/DB.php");
require("core/Router.php");
require("models/User.php");

$router = new Router();
$db = new DB();

if(!$db->connected) {
    die("Unable to connect to database");
}

require("routes/users.php");
require("routes/tickets.php");
require("routes/auth.php");
