<?php
    session_start();

    include "../../assets/include/global.inc.php";
    $bordereauDAO = new bordereauDAO();
    $email = $_SESSION["email"];
    if($_SESSION['role']=="utilisateur"){
      $bordereaux = $bordereauDAO->findAllBordereaux($email);
    }else{
      $tresorierDAO = new TresorierDAO();
      $tresorier = $tresorierDAO->findAllByMail($email);
      $idclub = $tresorier->get_idclub();

      $adherentDAO = new AdherentDAO();
      $adherents = $adherentDAO->findAllByIdClub($idclub);
    }
    
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

      if ($_SESSION['role']=="utilisateur"){
        foreach($bordereaux as $bordereau){
          echo '<tr>';
            echo '<td>'.$bordereau->get_annee().'</td>';   
            echo '<td>'.$bordereau->get_adresseMail().'</td>';  
            echo '<td><a href="bordereau2.php?annee='.$bordereau->get_annee().'&amp;idBordereau='.$bordereau->get_idBordereau().'">Selectionner</a></td>';
          echo '</tr>'; 
        }
      }else{
        foreach($adherents as $adherent){
          $mail = $adherent->get_adresseMail();
          $bordereaux = $bordereauDAO->findAllBordereaux($mail);
          foreach($bordereaux as $bordereau){
            echo '<tr>';
              echo '<td>'.$bordereau->get_annee().'</td>';   
              echo '<td>'.$bordereau->get_adresseMail().'</td>';  
              echo '<td><a href="bordereau2.php?annee='.$bordereau->get_annee().'&amp;idBordereau='.$bordereau->get_idBordereau().'&amp;email='.$bordereau->get_adresseMail().'">Selectionner</a></td>';
            echo '</tr>'; 
          }
        }
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