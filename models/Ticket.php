<?php

class Ticket extends BaseModel {
    private $user_id;
    private $title;
    private $description;

    public function __construct($data = null) {
        if(!empty($data)) {
            $this->user_id = $data["user_id"];
            $this->title = $data["title"];
            $this->description = $data["description"];
        }

        parent::__construct("tickets");
    }

    public function get_array_data() {
        $data = [
            "user_id" => $this->user_id,
            "title" => $this->title,
            "description" => $this->description,
            "created_at" => $this->created_at
        ];
        
        if(!empty($this->updated_at)) {
            $data["updated_at"] = $this->updated_at;
        }

        if(!empty($this->deleted_at)) {
            $data["deleted_at"] = $this->deleted_at;
        }
        
        return $data;
    }

    public static function validate($data) {
        $response = [];
        $success = true;

        if(empty($data["user_id"])) {
            $response["user_id"] = "required";
        }

        if(empty($data["title"])) {
            $response["title"] = "title";
        }

        if(empty($data["description"])) {
            $response["description"] = "required";
        }

        if(!empty($response)) {
            $success = false;
        }

        $response["success"] = $success;
        return $response;
    }
}