<?php
    session_start();

    include "../../assets/include/global.inc.php";
    $bordereauDAO = new bordereauDAO();
    $email = $_SESSION["email"];
    $bordereaux = $bordereauDAO->findAllBordereaux($email);
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
      echo "<table>";
        echo '<tr>';
          echo '<td>Année</td>';
          echo '<td>Auteur</td>';
          echo '<td>Action</td>';
        echo '</tr>';

      foreach($bordereaux as $bordereau){
        echo '<tr>';
          echo '<td>'.$bordereau->get_annee().'</td>';   
          echo '<td>'.$bordereau->get_adresseMail().'</td>';  
          echo '<td><a href="bordereau2.php">Selectionner</a></td>';
        echo '</tr>'; 
      }
      echo "</table>";
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