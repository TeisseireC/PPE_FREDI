<?php
  session_start();
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
          echo '<p>Vous êtes connecté avec l\'adresse suivante : '.$_SESSION['email'].'</p>';
        }
      ?>
      Bla bla blabla bla bla bla blabla, bla bla bla bla blalalalala, bla bla bla bla blala blala
    </section>
    <!-- End section --> 

    <!-- Start footer -->
    <footer>
      <p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>
    </footer>
    <!-- End footer -->

  </body>
</html>