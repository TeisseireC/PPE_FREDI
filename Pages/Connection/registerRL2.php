<?php
  $enfants = $_GET['enfants'];
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>S'inscrire</title>
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/styles.css"/> 
  </head>

  <body>
    <!-- Start header -->
    <header>
        <?php
          include "../../assets/include/menu2.php";
        ?>
    </header>
    <!-- End header -->

    <!-- Start section -->
    <section>      
      <form action="registerRL2.php" class="formulaire" method="post">
          <?php 
            for($i=0 ; $i < $enfants ; $i++){
              echo '<p>Numéro de licence<br/><input type="text" name="nom" required/>';
              echo '<select name="club" class="club">';
              echo '<select>';
              echo '</select></p>';
            }
          ?>

          <p>Mail<br/><input type="text" name="nom" required/></p>
          <p>Mot de passe<br/><input type="password" name="passe" required/></p>
          <p>Confirmation du mot de passe<br/><input type="password" name="passe" required/></p>
          <p><input type="submit" name="submit" value="OK" /><input type="reset" value="Réinitialiser"></p>
      </form>
    </section>
    <!-- End section --> 

    <!-- Start footer -->
    <footer>
        <p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>
    </footer>     
    <!-- End footer -->

  </body>
</html>