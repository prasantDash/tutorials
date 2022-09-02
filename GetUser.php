<?php
class GetUser{
    public function __construct($DBConn){
        $DBConn->createConnection();       
    }

    public function getUser($username,$password){
        $user = array(
            'username'=>$username,
            'jwt'=>'JWT tocken'
        );
        echo json_encode($user);
    }
}
?>