<?php

class BaseModel {
    protected $table;

    protected $id;

    protected $created_at;
    protected $updated_at;
    protected $deleted_at;

    protected function __construct($table) {
        $this->table = $table;
    }

    protected static function insert($data) {
        echo "will save";
    }
}