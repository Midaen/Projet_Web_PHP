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
    $result = $db->countCleanableModule();

    $response['error']=false;
    $response['message']= $result;

}else{
    $response['error']=true;
    $response['message']='You are NOT authorized';
}
// Ligne modifiée, cast en Integer et sélection du message sans la partie erreur
echo json_encode((int)$response['message']);
?>
