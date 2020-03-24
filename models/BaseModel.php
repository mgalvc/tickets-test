<?php

class BaseModel {
    private $db;
    private $table;

    protected $id;

    protected $created_at;
    protected $updated_at;
    // [TODO] check if deleted_at is really needed
    protected $deleted_at;

    protected function __construct($table) {
        $this->db = new DB();

        if(!$this->db->connected) {
            die("Unable to connect to database");
        }

        $this->table = $table;
    }

    protected function insert($data) {
        $fields = join(",", array_keys($data));
        $values = array_values($data);
        
        foreach ($values as $key => $value) {
            $values[$key] = "'$value'";
        }

        $values = join(",", $values);
        
        $sql = "INSERT INTO $this->table ($fields) VALUES ($values)";
        $result = $this->db->exec($sql);

        if(empty($result)) {
            return ["success" => false, "error" => $this->db->get_error()];
        }

        return ["success" => true, "inserted_id" => $this->db->get_inserted_id()];
    }

    protected function select($id = null) {
        if(empty($id)) {
            $sql = "SELECT * FROM $this->table";
        } else {
            $sql = "SELECT * FROM $this->table WHERE id = $id";
        }

        $result = $this->db->exec($sql);
        $response = [];

        while($row = mysqli_fetch_assoc($result)) {
            array_push($response, $row);
        }

        return $response;
    }

    protected function update($id, $data) {
        $set = [];

        foreach ($data as $field => $value) {
            if(!in_array($field, ["created_at", "deleted_at"])) {
                array_push($set, "$field = '$value'");
            }
        }

        $set = join(",", $set);
        $sql = "UPDATE $this->table SET $set WHERE id = $id";
        $result = $this->db->exec($sql);

        if(empty($result)) {
            return ["success" => false, "error" => $this->db->get_error()];
        }

        return ["success" => true];
    }

    protected function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id = $id";
        $result = $this->db->exec($sql);

        if(empty($result)) {
            return ["success" => false, "error" => $this->db->get_error()];
        }

        return ["success" => true];
    }
}