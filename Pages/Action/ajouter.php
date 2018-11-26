<?php
    include '../../assets/include/global.inc.php';     // Inclusion de la page de parametre 
    $ligneDeFraisDAO = new ligneDeFraisDAO();     // Appelle de la classe frediDAO

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
    
        $ligneDeFraisDAO->insertLigneDeFrais($date, $trajet, $kmsParcourus, $coutTrajet, $coutPeages, $coutRepas, $coutHebergement);
        header("location: ../Bordereau/bordereau.php");
    }
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Acceuil</title>
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
      <p>Association<br/><input type="text" name="association" value="<?php echo /*$ligneDeFrais->getAssociation()*/ "nothing" ?>" disabled="disabled"></p>
            <p>Date<br/><input type="date" name="date"></p>
            <p>Motif<br/><select name="motif" class="motif">
                <?php
                    //foreach($rows as $row){
                    //    echo "<option>$row</option>"
                    //}
                ?>
            </select></p>
            <p>Trajets<br/><input type="text" name="trajet"></p>
            <p>Kilomètres parcourus<br/><input type="number" name="kmsParcourus"></p>
            <p>Coût du trajet<br/><input type="number" step="0.01" name="coutTrajet"></p>
            <p>Coût des péages<br/><input type="number" step="0.01" name="coutPeages"></p>
            <p>Coût des repas<br/><input type="number" step="0.01" name="coutRepas"></p>
            <p>Coût de l'hébergement<br/><input type="number" step="0.01" name="coutHebergement"></p>
            <p><input type="hidden" name="id"/></p>
            <p><input type="submit" name="submit" value="Valider"/></p>
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