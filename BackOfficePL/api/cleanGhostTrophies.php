<?php
 
//creating response array
$response = array();
 
if($_SERVER['REQUEST_METHOD']=='GET'){
 
    //including the db operation file
    require_once '../includes/DbOperation.php';
 
    $db = new DbOperation();
    $result = $db->cleanTrophies();

    $response['error']=false;
    $response['message']= $result;
 
}else{
    $response['error']=true;
    $response['message']='You are NOT authorized';
}
echo json_encode($response);
