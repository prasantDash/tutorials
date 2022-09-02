<?php
function __autoload($className){
    include_once($className.".php");
}

$DBObj = new DBConnectPDO();
$getType = $_GET['type'];
if($getType == 'get'){    
    $username = 'admin';
    $password = 'admin';
    $obj = new GetUser($DBObj);
    $obj->getUser($username,$password);     
}elseif($getType == 'create'){
    $obj = new CreateUser($DBObj); 
}elseif($getType == 'update'){
    $obj = new UpdateUser($DBObj);
}elseif($getType == 'getAllUser'){
    $obj = new GetAllUser($DBObj);
}

?>