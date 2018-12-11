<?php
  
include '../../assets/include/global.inc.php';     // Inclusion de la page de parametre 
$ligneDeFraisDAO = new ligneDeFraisDAO();     // Appelle de la classe frediDAO
$id = NULL;                     //initailisation de $id
$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];    // $îd prend la valeur recuperee dans l'url

$submit = isset($_POST['submit']);      // $submit prend la valeur de submit venant du formulaire   
        
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

    $ligneDeFraisDAO->updateLigneDeFrais($id, $date, $trajet, $kmsParcourus, $coutTrajet, $coutPeages, $coutRepas, $coutHebergement);
    header("location: ../Bordereau/bordereau.php");
} else {        // sinon faire afficher les valeurs dans le formulaire en fopnction de l'id recupere dans l'url
    $ligneDeFrais = $ligneDeFraisDAO->findLigneDeFraisById($id);
}

?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Modifier ligne de frais</title>
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
      <!-- Start formulaire -->
      <form name="Formulaire" action="edit.php"  method="post" class="formAjouter"> 
            <p>Association<br/><input type="text" name="association" value="<?php echo /*$ligneDeFrais->getAssociation()*/ "nothing" ?>" disabled="disabled"></p>
            <p>Date<br/><input type="date" name="date" value="<?php echo $ligneDeFrais->get_dateFrais() ?>"></p>
            <p>Motif<br/><select name="motif" class="motif">
                <?php
                    //foreach($rows as $row){
                    //    echo "<option>$row</option>"
                    //}
                ?>
            </select></p>
            <p>Trajets<br/><input type="text" name="trajet" value="<?php echo $ligneDeFrais->get_trajet() ?>"></p>
            <p>Kilomètres parcourus<br/><input type="number" step="0.01" name="kmsParcourus" value="<?php echo $ligneDeFrais->get_km() ?>"></p>
            <p>Coût du trajet<br/><input type="number" step="0.01" name="coutTrajet" value="<?php echo $ligneDeFrais->get_coutTrajet() ?>"></p>
            <p>Coût des péages<br/><input type="number" step="0.01" name="coutPeages" value="<?php echo $ligneDeFrais->get_coutPeage() ?>"></p>
            <p>Coût des repas<br/><input type="number" step="0.01" name="coutRepas" value="<?php echo $ligneDeFrais->get_coutRepas() ?>"></p>
            <p>Coût de l'hébergement<br/><input type="number" step="0.01" name="coutHebergement"  value="<?php echo $ligneDeFrais->get_coutHebergement() ?>"></p>
            <p><input type="hidden" name="id" value="<?php echo $ligneDeFrais->get_idFrais() ?>"/></p>
            <p><input type="submit" name="submit" value="Valider"/><input type="reset" name="reset" value="Réinitialiser"></p>
            
        </form>
        <!-- End formulaire -->
    </section>
    <!-- End section --> 

    <!-- Start footer -->
    <footer>
        <p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>
    </footer>
    <!-- End footer -->

  </body>
</html>