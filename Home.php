
<!DOCTYPE html>
<html lang="fr">
<head>
  <link href="materialize/css/materialize.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <nav class="red accent-3">
      <div class="nav-wrapper container">
        <a href="#" class="brand-logo"> kaSTATrophik </a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="tableauBord.php">Tableau de bord </a></li>
          <li><a href="gestionGroupe.php">Gestion des groupes</a></li>
        </ul>
      </div>
    </nav>

    <div class='container center'>
      <div class="section">
        <h1 class=" header">Bienvenue <?php echo $_COOKIE['username']; ?></h1>
        <p class="flow-text">Vous êtes actuellement connecté en tant qu'administrateur</p>
      </div>
     </div>

<div class='container'>
     <div class="row">
   <div class="col s6 center">
      <div class='icon-block'>
     <h1 class="center"><i class="material-icons" style="font-size:56px">school</i></h1>
     <p class="light flow-text"> Vous pouvez visualiser les statistiques afin d'avoir une vue générale des donées concernant les trophées , les étudiants et les modules .
</p>
 </div>
   </div>
   <div class="col s6 center">
     <div class='icon-block'>
     <h1 class="center"><i class="material-icons" style="font-size:56px">group</i></h1>
     <p class="light flow-text"> Le gestionnaire de groupe vous permet de gérer les groupes d'élèves , de les changer de groupes ou de les supprimer. <br><br><br><br>
</p>

</div>
</div>

   </div>
    </div>

     <footer class="  red accent-3 page-footer">
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
