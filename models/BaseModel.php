<?php

class BaseModel {
    private $table;

    public function __construct($table) {
        $this->table = $table;
    }
}