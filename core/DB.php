<?php

class DB {
    const SERVER = "localhost";
    const USERNAME = "root";
    const PASSWORD = "root";
    const DATABASE = "jestor_test";

    private $conn;
    public $connected = true;

    public function __construct() {
        $this->conn = new mysqli(self::SERVER, self::USERNAME, self::PASSWORD, self::DATABASE);

        if($this->conn->connect_error) {
            $this->connected = false;
        }
    }

    public function exec($sql) {
        return mysqli_query($this->conn, $sql);
        // $response = [];
        // while($row = mysqli_fetch_assoc($result)) {
        //     array_push($response, $row);
        // }
        // return $response;
    }

    public function get_error() {
        return $this->conn->error;
    }

    public function get_inserted_id() {
        return $this->conn->insert_id;
    }
}