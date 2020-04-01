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

    public function save() {
        $now = new DateTime();
        $this->created_at = $now->format("Y-m-d H:i:s");
        return $this->insert($this->get_array_data());
    }

    public function get_array_data() {}

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

    public function get($id = null) {
        return $this->select($id);
    }

    protected function select($id = null) {
        if(empty($id)) {
            $sql = "SELECT * FROM $this->table ORDER BY created_at DESC";
        } else {
            $sql = "SELECT * FROM $this->table WHERE id = $id ORDER BY created_at DESC";
        }

        $result = $this->db->exec($sql);
        $response = [];

        while($row = mysqli_fetch_assoc($result)) {
            array_push($response, $row);
        }

        return $response;
    }

    public function find($params) {
        return $this->select_where($params);
    }

    private function select_where($params) {
        $where = [];

        foreach($params as $field => $value) {
            array_push($where, "$field = '$value'");
        }

        $where = join(" AND ", $where);
        $sql = "SELECT * FROM $this->table WHERE $where";
        $result = $this->db->exec($sql);
        $response = [];

        while($row = mysqli_fetch_assoc($result)) {
            array_push($response, $row);
        }

        return $response;
    }

    public function edit($id, $data) {
        $now = new DateTime();
        $data["updated_at"] = $now->format("Y-m-d H:i:s");
        return $this->update($id, $data);
    }

    private function update($id, $data) {
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

    public function remove($id) {
        return $this->delete($id);
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