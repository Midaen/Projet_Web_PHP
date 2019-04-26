<?php

//creating response array
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values
    $group_id = $_POST['group_id'];

    //including the db operation file
    require_once '../includes/DbOperation.php';

    $db = new DbOperation();

    $result = $db->getStudentsUnderGroup($group_id);
    //print_r($result);

    $myArray = array();
	//$row = array();
    //$result->fetch_all();
   //print_r($row);
    while($row = $result->fetch_object()) {
       $myArray[] = $row;
    }

  // $myArray = $result->fetch_all();

    $response['error'] =false;
    $response['message'] = 'OK';
    $response['result'] = $myArray;

} else{
    $response['error']=true;
    $response['message']='You are NOT authorized';
}
echo json_encode($response['message']);
