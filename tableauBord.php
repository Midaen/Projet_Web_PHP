<!DOCTYPE html>

<html lang="fr">
<head>
  <link href="materialize/css/materialize.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <nav class="red accent-3">
      <div class="nav-wrapper container">
        <a href="home.php" class="brand-logo">kaSTATrophik</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="tableauBord.php">Tableau de bord </a></li>
          <li><a href="gestionGroupe.php">Gestion des groupes</a></li>
        </ul>
      </div>
    </nav>


      <div class="container">
        <div class="section">
          <h2 class="header center">Tableau de bord</h2>
        </div>
        <div class="section row">
            <div class="col s3"></div>
          <div class="col s3">
            <h1 class=" header center light-blue-text"><b>
              <?php
              require("BackOfficePL\api\getStudentCount.php");
              ?>
            </b></h1>
            <h3 class=" header center"><i>Etudiants<i></h3>

          </div>
            <div class="col s4">
              <br>
              <h5 class="header center"><p><span class='light-blue-text'><?php require("BackOfficePL\api\getStudentsWithoutTrophyCount.php");?></span><span> sans trophées</span></p></h5>
              <h5 class="header center"><p><span class='light-blue-text'><?php require("BackOfficePL\api\getStudentsNeverConnectedCount.php");?></span><span> jamais connectés </span></p></h5>
              <h5 class="header center"><p><span class='light-blue-text'>/</span><span> groupes peuplés</span></p></h5>

      </div>
    </div>
<!-- Container 1 -->
    <div class="section row">
        <div class="col s3"></div>
      <div class="col s4">

          <h5 class="header center"><p><span class='green-text'><?php require("BackOfficePL\api\getUndeliveredTrophiesCount.php");?></span><span> non délivrés</span></p></h5>
          <h5 class="header center"><p><span class='green-text'><?php require("BackOfficePL\api\getInactiveTrophiesCount.php");?></span><span> inactifs</span></p></h5>
          <h5 class="header center"><p><span class='green-text'><?php require("BackOfficePL\api\getGhostTrophiesCount.php");?></span><span> fantômes</span></p></h5>
          <h5 class="header center"><p><span class='green-text'><?php require("BackOfficePL\api\getCleanableTrophiesCount.php");?></span><span> nettoyable</span></p></h5>

      </div>
        <div class="col s3">
          <h1 class=" header center green-text"><b><?php require("BackOfficePL\api\getTrophyCount.php");?></b></h1>
          <h3 class=" header center"><i>Trophées<i></h3>

  </div>
</div>

<div class="section row">
    <div class="col s3"></div>
  <div class="col s3">
    <br>
    <br>
    <h1 class=" header center orange-text"><b><?php require("BackOfficePL\api\getModuleCount.php");?></b></h1>
    <h3 class=" header center"><i>Modules<i></h3>

  </div>
    <div class="col s4">
      <br>
      <h5 class="header center"><p><span class='orange-text'><?php require("BackOfficePL\api\getActiveModuleWithTrophiesCount.php");?></span><span> actifs avec trophées</span></p></h5>
      <h5 class="header center"><p><span class='orange-text'><?php require("BackOfficePL\api\getActiveModuleWithoutTrophiesCount.php");?></span><span> actifs sans trophées </span></p></h5>
      <h5 class="header center"><p><span class='orange-text'><?php require("BackOfficePL\api\getInactiveModuleCount.php");?></span><span> inactifs</span></p></h5>
      <h5 class="header center"><p><span class='orange-text'><?php require("BackOfficePL\api\getGhostModuleCount.php");?></span><span> fantômes</span></p></h5>
      <h5 class="header center"><p><span class='orange-text'><?php require("BackOfficePL\api\getCleanableModuleCount.php");?></span><span> nettoyable</span></p></h5>

</div>
</div>

<!-- ici -->
<div class="section row">
    <div class="col s3"></div>
  <div class="col s4">
<br><br>
      <h5 class="header center"><p><span class='red-text'><?php require("BackOfficePL\api\getDeliveredTrophiesCount.php");?></span><span> trophées ≠</span></p></h5>
      <h5 class="header center"><p><span class='red-text'><?php require("BackOfficePL\api\getStudentsWithTrophiesCount.php");?></span><span> étudiants ≠</span></p></h5>


  </div>
    <div class="col s3">
      <h1 class=" header center red-text"><b><?php require("BackOfficePL\api\getCopiesCount.php");?></b></h1>
      <h3 class=" header center"><i>exemplaires<i></h3>
      </div>
    </div>
  </div>




     <footer class="page-footer red accent-3">
       <div class="footer-copyright red accent-3">
                  <div class="container">
                  © 2018 Copyright
                  <a class="grey-text text-lighten-3 right" href="#!">More Links</a>
                  </div>
                </div>
     </footer>
  <script src="materialize\js\materialize.js"></script>
</body>
</html>
