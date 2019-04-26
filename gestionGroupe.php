<!DOCTYPE html>
<html lang="fr">
<head>
  <link href="materialize/css/materialize.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <nav class="grey lighten-4">
      <div class="nav-wrapper">
        <a class="brand-logo pink-text accent-2 center"> choix d'un groupe ayant des étudiants</a>
      </div>
    </nav>
<div class="center">
<?php require("BackOfficePL\api\showGroup.php");?>
</div>

     <footer class="  red accent-3 page-footer2 ">
       <div class=" red accent-3 footer-copyright">
                  <div class="container">
                  © 2018 Copyright
                  <a class="grey-text text-lighten-3 right" href="Home.php">More Links</a>
                  </div>
                </div>
                <br>
     </footer>


  <script src="materialize\js\materialize.js"></script>
</body>
</html>
