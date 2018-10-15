<?php
  
include "DAO.php";      // Inclusion de la page de parametre 
$frediDAO = new frediDAO();     // Appelle de la classe frediDAO
$id = NULL;                     //initailisation de $id
$id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];    // $îd prend la valeur recuperee dans l'url

$submit = isset($_POST['submit']);      // $submit prend la valeur de submit venant du formulaire   
        
if($submit == 1){               // au submit faire
    $association = isset($_POST['association']) ? $_POST['association'] : "";
    $date = isset($_POST['date']) ? $_POST['date'] : "";
    $trajet = isset($_POST['trajet']) ? $_POST['trajet'] : "";
    $kmsParcourus = isset($_POST['kmsParcourus']) ? $_POST['kmsParcourus'] : "";
    $peages = isset($_POST['peages']) ? $_POST['peages'] : "";
    $repas = isset($_POST['repas']) ? $_POST['repas'] : "";
    $hebergement = isset($_POST['hebergement']) ? $_POST['hebergement'] : "";
    $id = isset($_POST['id']) ? $_POST['id'] : "";

    $voitureDAO->update($id, $marque, $modele);
    header("location: index.php");
} else {        // sinon faire afficher les valeurs dans le formulaire en fopnction de l'id recupere dans l'url
    $voiture = $voitureDAO->find($id);
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
      <form name="Formulaire" action="ajouter.php"  method="post" class="formAjouter"> 
            <p>Association<br/><input type="text" name="association" value="<?php echo $fredi->getAssociation() ?>" disabled="disabled"></p>                        
            <p>Date<br/><input type="date" name="date" value="<?php echo $fredi->getDate() ?>" disabled="disabled"></p>
            <p>Motif<br/><select name="motif" class="motif">
                <?php
                    //foreach($rows as $row){
                    //    echo "<option>$row</option>"
                    //}
                ?>
            </select></p>
            <p>Trajets<br/><input type="text" name="trajet" value="<?php echo $fredi->getTrajet() ?>" disabled="disabled"></p>
            <p>Kilomètres parcourus<br/><input type="number" name="kmsParcourus" value="<?php echo $fredi->getKmsparcourus() ?>" disabled="disabled"></p>
            <p>Coût des péages<br/><input type="number" name="peages" value="<?php echo $fredi->getPeages() ?>" disabled="disabled"></p>
            <p>Coût des repas<br/><input type="number" name="repas" value="<?php echo $fredi->getRepas() ?>" disabled="disabled"></p>
            <p>Coût de l'hébergement<br/><input type="number" name="hebergement"  value="<?php echo $fredi->getHebergement() ?>" disabled="disabled"></p>
            <p><input type="hidden" name="id" value="<?php echo $fredi->getId() ?>"/></p>
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