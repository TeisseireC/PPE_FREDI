<?php

session_start();
$mail = $_SESSION['email'];

include '../../assets/include/global.inc.php';
$tresorierDAO = new TresorierDAO();
$adherentDAO = new AdherentDAO();
$respLegalDAO = new RespLegalDAO();
?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Accueil - Trésorier</title>
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
        <p>Bienvenue sur le site de gestion des bordereaux, Trésorier.
          Sélectionner "Liste bordereaux" pour accéder à tous les bordereaux des utilisateurs de la Ligue et 
          vérifier l'état de chacun des bordereaux pour, par la suite, les valider ou les modifier. </p>
          <?php
            $tresorier = $tresorierDAO->findAllbyMail($mail);
            $adherents = $adherentDAO->findAllByIdClub($tresorier->get_idClub());
          
          foreach($adherents as $adherent) {
            if($adherent -> get_adresseMail() == NULL) {
              $respLegal = $respLegalDAO->findById($adherent->get_idRespLegal());
              echo '<p><a href="../../assets/class/Mon_Pdf.php?mail='. $respLegal->get_adresseMail() .'">Générer PDF de '.$respLegal->get_prenomRespLegal() . '_'. $respLegal->get_nomRespLegal() .'</a></p>';
              echo '<p><a href="../../assets/outfile/cerfa_'.$respLegal->get_prenomRespLegal() . '_'. $respLegal->get_nomRespLegal() .'_'. date('Y') .'.pdf">Visualiser le PDF</a></p>';
              
            }
            else{
              echo '<p><a href="../../assets/class/Mon_Pdf.php?licence='. $adherent->get_numLicence() .'">Générer PDF de '.$adherent->get_prenomAdh() . '_'. $adherent->get_nomAdh() .'</a></p>';
              echo '<p><a href="../../assets/outfile/cerfa_'.$adherent->get_prenomAdh() . '_'. $adherent->get_nomAdh() .'_'. date('Y') .'.pdf">Visualiser le PDF</a></p>';
            }
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