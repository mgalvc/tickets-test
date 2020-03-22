<?php 

include("BaseModel.php");

class User extends BaseModel {
    private $login;
    private $password;
    private $public_name;

    public function __construct($data) {
        $this->login = $data["login"];
        $this->password = $data["password"];
        $this->public_name = $data["public_name"];

        parent::__construct("users");
    }

    public function save() {
        BaseModel::insert(["algo"]);
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

    }
}