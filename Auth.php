<?php
require('db.inc.php');
$login = $_POST['Login'];
$passwordInput = $_POST['Password'];
try {/*Début try*/
    //Connection à la bdd via l'objet PDO
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Mode Exception pour les erreurs
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Création de la commande

    				$ok = false;

    			$sql = "SELECT username,password FROM users WHERE username='".$login."' AND password='".$passwordInput."' AND role_id=1";

    				$infos_st = $db->query($sql);

    				if ($infos_rs = $infos_st->fetch()) {
    					// si la requete s'execute sans erreur et qu'une "vraie" ligne est retournee


              $ok = true;
              setcookie('username', $login , time() + 365*24*3600, null, null, false, true);
          echo "Connexion ".$_COOKIE['username'];
          echo "<script type='text/javascript'>document.location.replace('Home.php');</script>";


        }else{

          echo 'Identifiants incorects<br><br>';
          echo 'Redirection en cours...';
        echo '<meta http-equiv="Refresh" content="2;URL=index.php">';
        setcookie('username', "" , time() + 365*24*3600, null, null, false, true);
        }

  } /*fin try*/
catch(PDOException $e)  {/*Debut catch*/
  echo $sql . "<br>" . $e->getMessage();
}/*fin catch*/
 ?>
