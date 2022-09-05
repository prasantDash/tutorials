<?php
//header("Content-Type: application/json");
function __autoload($className){
    include_once($className.".php");
}

$DBObj = new DBConnectPDO();
if(isset($_GET['type'])){
    $getType = $_GET['type'];
    if(!empty($getType)){
        if($getType == 'get'){ 
            $bodyParams = json_decode(file_get_contents('php://input')); 
            if(isset($bodyParams->username) && isset($bodyParams->password)){
                $username = $bodyParams->username;
                $password = md5($bodyParams->password);
                if(empty($username) || empty($password)){
                    http_response_code('404');
                    $responce = array(
                        'status'=>'fail',
                        'message'=>'Parameter value are missing'
                    );
                    echo json_encode($responce);    
                }else{
                    $obj = new GetUser($DBObj);
                    $obj->getUser($username,$password); 
                }
            } else{
                http_response_code('404');
                    $responce = array(
                        'status'=>'fail',
                        'message'=>'Parameter missing'
                    );
                    echo json_encode($responce); 
            }          
            
            
            
            
             
        }elseif($getType == 'create'){
            $obj = new CreateUser($DBObj); 
        }elseif($getType == 'update'){
            $obj = new UpdateUser($DBObj);
        }elseif($getType == 'getAllUser'){
            $obj = new GetAllUser($DBObj);
        }else{
            http_response_code('404');
            $responce = array(
                'status'=>'fail',
                'message'=>'URL parameter value are not matching'
            );
            echo json_encode($responce); 
        }
    }else{
        http_response_code('404');
        $responce = array(
            'status'=>'fail',
            'message'=>'URL parameter value is missing'
        );
        echo json_encode($responce);
    }    
}else{
    http_response_code('404');
    $responce = array(
        'status'=>'fail',
        'message'=>'URL parameter missing'
    );

    echo json_encode($responce);
}


?>