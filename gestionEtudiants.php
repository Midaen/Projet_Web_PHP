<?php
session_start();

isset($_POST['id']) ? $id = $_POST['id'] : $id = $_GET['id']
 ?>

<!DOCTYPE html>

<html lang="fr">
<head>
  <link href="materialize/css/materialize.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <nav class="grey lighten-4">
      <div class="nav-wrapper">
        <a > </a>
        <a class="brand-logo pink-text accent-2 center"> choix d'un groupe ayant des étudiants</a>
      </div>
    </nav>
<div class="center">
  <?php
        $_SESSION['idGroup']=$id;
     ?>
<?php require("BackOfficePL\api\showStudents.php");?>

</div>

<footer class=" red accent-3 page-footer">
  <div class=" red accent-3 footer-copyright">
             <div class="container">
             © 2018 Copyright
             <a class="grey-text text-lighten-3 right" href="#!">More Links</a>
             </div>
           </div>
</footer>

  <script src="materialize\js\materialize.js"></script>
</body>
</html>
