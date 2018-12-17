<?php

    session_start();
    $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
    include '../../assets/include/global.inc.php';     // Inclusion de la page de parametre 
    $ligneDeFraisDAO = new ligneDeFraisDAO();     // Appelle de la classe frediDAO   
    $bordereauDAO = new bordereauDAO();     
    $motifDAO = new motifDAO();     
    $adherentDAO = new adherentDAO();
    $clubDAO = new clubDAO();

    $email = $_SESSION['email'];

    $submit = isset($_POST['submit']);
    if($submit == 1){               // au submit faire
        $association = isset($_POST['association']) ? $_POST['association'] : "";
        $date = isset($_POST['date']) ? $_POST['date'] : "";
        $trajet = isset($_POST['trajet']) ? $_POST['trajet'] : "";
        $kmsParcourus = isset($_POST['kmsParcourus']) ? $_POST['kmsParcourus'] : "";
        $coutTrajet = isset($_POST['coutTrajet']) ? $_POST['coutTrajet'] : "";
        $coutPeages = isset($_POST['coutPeages']) ? $_POST['coutPeages'] : "";
        $coutRepas = isset($_POST['coutRepas']) ? $_POST['coutRepas'] : "";
        $coutHebergement = isset($_POST['coutHebergement']) ? $_POST['coutHebergement'] : "";
        $id = isset($_POST['id']) ? $_POST['id'] : "";
    
        $ligneDeFraisDAO->deleteLigneDeFrais($id);
        header("location: ../Bordereau/bordereau.php");
    } else {        // sinon faire afficher les valeurs dans le formulaire en fopnction de l'id recupere dans l'url
      $ligneDeFrais = $ligneDeFraisDAO->findLigneDeFraisById($id);
    }

    if(isset ($_SESSION['respLeg'])){
      // ne rien faire
    }else{
      $adherent = $adherentDAO->find($email);
      $idclub = $adherent->get_idClub();

      $club = $clubDAO->find($idclub);
    }
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>PPE-G4-FREDI</title>
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/styles.css"/> 
  </head>

  <body>
    <!-- Start header -->
    <header>
        <?php
          include "../../assets/include/menu2.php";
          $idMotif = $ligneDeFrais->get_idMotifs();
          $motif = $motifDAO->findByIdMotif($idMotif);
        ?>
    </header>
    <!-- End header -->

    <!-- Start section -->
    <section>        
      <h3><center><p>Vous êtes sur le point de supprimer la ligne de frais ci dessous, cliquez sur valider pour continuer.</p></center></h3>
      <form name="Formulaire" action="delete.php"  method="post" class="formAjouter">
        <p>Association<br/><input type="text" name="association" value="<?php if(isset ($_SESSION['respLeg'])){echo "nothing";}else{echo $club->get_nomclub();}?>" disabled="disabled"></p>
        <p>Date<br/><input type="date" name="date" value="<?php echo $ligneDeFrais->get_dateFrais() ?>" disabled="disabled"></p>
        <p>Motif<br/><input type="text" name="motif" value="<?php echo $motif->get_libelleMotifs() ?>" disabled="disabled"></p>
        <p>Trajets<br/><input type="text" name="trajet" value="<?php echo $ligneDeFrais->get_trajet() ?>" disabled="disabled"></p>
        <p>Kilomètres parcourus<br/><input type="number" name="kmsParcourus" value="<?php echo $ligneDeFrais->get_km() ?>" disabled="disabled"></p>
        <p>Coût du trajet<br/><input type="number" step="0.01" name="coutTrajet" value="<?php echo $ligneDeFrais->get_coutTrajet() ?>" disabled="disabled"></p>
        <p>Coût des péages<br/><input type="number" step="0.01" name="coutPeages" value="<?php echo $ligneDeFrais->get_coutPeage() ?>" disabled="disabled"></p>
        <p>Coût des repas<br/><input type="number" step="0.01" name="coutRepas" value="<?php echo $ligneDeFrais->get_coutRepas() ?>" disabled="disabled"></p>
        <p>Coût de l'hébergement<br/><input type="number" step="0.01" name="coutHebergement"  value="<?php echo $ligneDeFrais->get_coutHebergement() ?>" disabled="disabled"></p>
        <p><input type="hidden" name="id" value="<?php echo $ligneDeFrais->get_idFrais() ?>"/></p>
        <p><input type="submit" name="submit" value="Valider"/></p>
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