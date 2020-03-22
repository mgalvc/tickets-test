<?php

class BaseModel {
    private $db;
    protected $table;

    protected $id;

    protected $created_at;
    protected $updated_at;
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
}