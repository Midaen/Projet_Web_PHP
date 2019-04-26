<?php
 
//creating response array
$response = array();
 
if($_SERVER['REQUEST_METHOD']=='GET'){
 
    //including the db operation file
    require_once '../includes/DbOperation.php';
 
    $db = new DbOperation();
    $result = $db->cleanTrophiesModules();

    if ($result == 'Success') {
      $db = new DbOperation(); 
      $result = $db->cleanModules();
      $response['error']=false;
      $response['message']= 'Success';
    } else {
      $response['error']=true;
      $response['message']= 'Pb avec la BD';
    }
} else {
    $response['error']=true;
    $response['message']='You are NOT authorized';
}
echo json_encode($response);
