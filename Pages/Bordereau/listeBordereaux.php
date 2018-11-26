<?php
    include "../../assets/include/global.inc.php";
    $numLicence = '170540010443';
    $bordereauDAO = new bordereauDAO();
    $bordereaux = $bordereauDAO->findBordereaux($numLicence);
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Liste des bordeaux</title>
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
      <?php  
        foreach($bordereaux as $bordereau){
          echo "<table>";
            
          echo "</table>";
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