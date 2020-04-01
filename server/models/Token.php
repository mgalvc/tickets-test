<?php

class Token extends BaseModel {
    private $user_id;
    private $token;
    private $expires_at;

    public function __construct() {
        parent::__construct("tokens");
    }

    public function save() {
        $now = new DateTime();

        $expires = new DateTime();
        $expires = $expires->add(new DateInterval("PT6H"));
        $this->created_at = $now->format("Y-m-d H:i:s");
        $this->expires_at = $expires->format("Y-m-d H:i:s");
        
        return $this->insert($this->get_array_data());
    }

    public function get_array_data() {
        $data = [
            "user_id" => $this->user_id,
            "token" => $this->token,
            "expires_at" => $this->expires_at,
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

    public function generate_token($login, $password) {
        $user = new User();
        $user = $user->find(["login" => $login, "password" => $password])[0];
        
        if(empty($user)) {
            return [
                "success" => false,
                "error" => "wrong login or password"
            ];
        }

        $this->user_id = $user["id"];
        $this->token = md5(uniqid($user["login"].$user["public_name"], true));
        $response = $this->save();
        
        if(!empty($response["success"])) {
            return [
                "success" => true,
                "auth" => $this->get_array_data()
            ];
        } else {
            return $response;
        }
    }

    public function remove($token) {
        $result = $this->find(["token" => $token])[0];
        if(empty($result)) {
            return ["success" => false, "error" => "invalid token"];
        }
        return $this->delete($result["id"]);
    }
}