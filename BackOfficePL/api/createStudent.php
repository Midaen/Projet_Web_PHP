<?php
 
//creating response array
$response = array();
 
if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $group_id = $_POST['group_id'];

    //including the db operation file
    require_once '../includes/DbOperation.php';
 
    $db = new DbOperation();


    if ($db->verifyStudent($username)) {
	$response['error']=true;
        $response['message']='User already exists';
    } else {

 	$response['message']='OK';
    	//inserting values 
    	if($db->createStudent($username, $firstname, $lastname, $email, $group_id)){
        	$response['error']=false;
       		$response['message']='User added';
    	}else{
 
        	$response['error']=true;
        	$response['message']='Could not add user';
    	}
    } 
}else{
    $response['error']=true;
    $response['message']='You are not authorized';
}
echo json_encode($response);
