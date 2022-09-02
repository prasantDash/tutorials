<?php
class CreateUser{
    public function __construct($DBConn){
        $DBConn->createConnection();               
    }
    public function testCreateUser(){
        echo "Test User";
    }
}
?>