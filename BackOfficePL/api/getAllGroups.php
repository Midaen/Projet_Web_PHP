<?php

//creating response array
$response = array();

if($_SERVER['REQUEST_METHOD']=='GET'){

    //including the db operation file
    /*
          Attention chemin Absolu, dois être changé
          Commande Require

    */
  require_once 'C:\wamp64\www\PHP\BackOfficePL\includes\DbOperation.php';

    $db = new DbOperation();
    $result = $db->getGroups();
	//print_r($result);

    $myArray = array();

    while($row = $result->fetch_object()) {
       $myArray[] = $row;
    }
//    echo json_encode($myArray);



    $response['error'] =false;
    $response['message'] = 'OK';
    $response['result'] = $myArray;

} else{
    $response['error']=true;
    $response['message']='You are NOT authorized';
}
echo json_encode($response);
//echo json_encode($myArray);
?>
