<?php

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class GetUser{
    public $con;
    public function __construct($DBConn){
        $this->con = $DBConn->createConnection();       
    }

    public function getUser($username,$password){
        $stmt = $this->con->query("SELECT id,username FROM user where username='".$username."' AND password='".$password."'");
        $data = $stmt->fetchObject();
        if(isset($data->id)){
            //Code added for generating tocken
            require './vendor/autoload.php';
            $payload = [
                "iss"=> $this->httpUrl(),
                "iat"=> time(),
                "nbf"=> time(),
                "exp"=> time() + 60,
                "aud"=>"myuser",
                "data" => [
                    "id"=> $data->id,
                    "name"=> $data->username,
                    
                ],
            
            ];
            $key = "mykey";
            $jwt = JWT::encode($payload, $key, 'HS256');
            http_response_code(200);
            $user = array(
                'status'=>'Success',
                'data'=>$data->username,
                'jwt'=>$jwt            
            );
            echo json_encode($user);
        }else{
            http_response_code(404);
            $responce = array(
                'status'=>'fail',
                'message'=>'User not found'
                        
            );
            echo json_encode($responce);
        }
        
        
    }

    public function httpUrl(){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        return $protocol . "://" . $_SERVER['HTTP_HOST'];
    }
}
?>