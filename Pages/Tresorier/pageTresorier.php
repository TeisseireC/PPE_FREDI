<?php

session_start();
$mail = $_SESSION['email'];

include '../../assets/include/global.inc.php';
$adherent = new adherentDAO();
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
          Sélectionner "Bordereaux" pour accéder à tous les bordereaux des utilisateurs de la Ligue et 
          vérifier l'état de chacun des bordereaux pour, par la suite, les valider ou les modifier. </p>
          <?php
            $adherent->findAllbyMail($mail);
          ?>
          <p><a href="../../assets/class/Mon_Pdf.php?mail=<?php echo $mail ?>">PDF</a></p>
          <p><a href='../../assets/outfile/cerfa_<?php echo $adherent->get_prenomAdh() . '_'. $adherent->get_nomAdh() .'_'. date('Y') ?>.pdf'>Mon PDF</a></p>

    </section>
    <!-- End section -->

    <!-- Start footer -->
    <footer>
        <p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>                  
    </footer>
    <!-- End footer -->
                      
  </body>
</html>