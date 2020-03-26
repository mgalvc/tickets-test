<?php

require("core/DB.php");
require("core/Router.php");

$router = new Router();

require("models/BaseModel.php");
require("models/User.php");
require("models/Token.php");

require("routes/users.php");
require("routes/tickets.php");
require("routes/auth.php");
