<?php

class DB {
    const SERVER = "localhost";
    const USERNAME = "root";
    const PASSWORD = "root";

    private $conn;
    public $connected = true;

    public function __construct() {
        $this->conn = new mysqli(self::SERVER, self::USERNAME, self::PASSWORD);

        if($this->conn->connect_error) {
            $this->connected = false;
        }
    }
}