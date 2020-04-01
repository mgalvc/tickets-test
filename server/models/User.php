<?php 

class User extends BaseModel {
    private $login;
    private $password;
    private $public_name;

    public function __construct($data = null) {
        if(!empty($data)) {
            $this->login = $data["login"];
            $this->password = $data["password"];
            $this->public_name = $data["public_name"];
        }

        parent::__construct("users");
    }

    public function get_array_data() {
        $data = [
            "login" => $this->login,
            "password" => $this->password,
            "public_name" => $this->public_name,
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

        if(empty($data["login"])) {
            $response["login"] = "required";
        } else if(User::already_exists($data["login"])) {
            $response["login"] = "unavailable";
        }

        if(empty($data["password"])) {
            $response["password"] = "required";
        }

        if(empty($data["public_name"])) {
            $response["public_name"] = "required";
        }

        if(!empty($response)) {
            $success = false;
        }

        $response["success"] = $success;
        return $response;
    }

    private static function already_exists($login) {
        $user = new User();
        return !empty($user->find(["login" => $login]));
    }
}