<?php
  session_start();
  //test
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Accueil</title>
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/styles.css"/> 
  </head>

  <body>
    <!-- Start header -->
    <header>
        <?php
          include "assets/include/menu.php";
        ?>
    </header>
    <!-- End header -->

    <!-- Start section -->
    <section>   
      <?php
        if (isset($_SESSION['email'])){
          echo '<p>Bienvenue, vous êtes actuellement connecté avec l\'adresse suivante : '.$_SESSION['email'].'</p>';
          echo '<p>Si vous rencontrez des erreurs n\'hésitez pas à nous signaler un issue en cliquant <a href="https://github.com/TeisseireC/PPE_FREDI/issues" target="_blank" >ici</a></p>'; 
        }else{
          echo '<p>Bienvenue sur notre site, veillez vous connecter afin d\'avoir accès aux fonctionnalitées du site.</p>';
          echo '<p>Si vous rencontrez des erreurs n\'hésitez pas à nous signaler un issue en cliquant <a href="https://github.com/TeisseireC/PPE_FREDI/issues" target="_blank" >ici</a></p>'; 
        }
      ?>
    </section>
    <!-- End section --> 

    <!-- Start footer -->
    <footer>
      <p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>
    </footer>
    <!-- End footer -->

  </body>
</html>