<?php
class CreateUser{
    public $con;
    public function __construct($DBConn){
        $this->con = $DBConn->createConnection();       
    }
    public function userCreate($username,$password){
        $stmt = $this->con->query("SELECT id FROM users where username='".$username."'");
        $data = $stmt->fetchObject();
        if(isset($data->id) && !empty($data->id)){
            http_response_code(404);
            $responce = array(
                'status'=>'fail',
                'message'=> "Username exits please user another username"                 
            );
            echo json_encode($responce);
        }else{
            $sql = "INSERT INTO users (username,password) VALUES (?,?)";
            $stmt= $this->con->prepare($sql);
            $result = $stmt->execute([$username, $password]);
            if($result){
                $DBObj = new DBConnectPDO();
                $obj = new GetUser($DBObj);
                $obj->getUser($username,$password);
            }else{
                http_response_code(404);
                $responce = array(
                    'status'=>'fail',
                    'message'=> "Unable to create user"                 
                );
                echo json_encode($responce);
            }
            
        }
        
    }
}
?>