<?php

//creating response array
$response = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values
    $student_id = $_POST['student_id'];

    //including the db operation file
    require_once '../includes/DbOperation.php';

    $db = new DbOperation();
    if ($result = $db->deleteStudent($student_id) ) {
      echo "<script type='text/javascript'>document.location.replace('gestionEtudiants.php');</script>";

    	$response['error'] =false;
    	$response['message'] = 'OK';
    } else {
	$response['error'] =true;
        $response['message'] = 'problem during delete';
    }

} else{
    $response['error']=true;
    $response['message']='You are NOT authorized';
}
