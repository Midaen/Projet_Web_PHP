<?php
 
//creating response array
$response = array();
 
if($_SERVER['REQUEST_METHOD']=='POST'){

    //getting values
    $group_id = $_POST['group_id'];
    $student_id = $_POST['student_id'];

    //including the db operation file
    require_once '../includes/DbOperation.php';
 
    $db = new DbOperation();

    if ($result = $db->setStudentGroup($student_id, $group_id)) {
       $response['error'] =false;
       $response['message'] = 'OK';
    } else {
       $response['error'] =true;
       $response['message'] = 'Erreur pendant le changement de groupe';
    }
} else{
    $response['error']=true;
    $response['message']='You are NOT authorized';
}
echo json_encode($response);
