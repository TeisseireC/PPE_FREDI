<?php
    session_start();
    $email = $_SESSION['email'];
    $annee = date('Y');

    include '../../assets/include/global.inc.php';
    $bordereauDAO = new bordereauDAO();
    $bordereau = $bordereauDAO->findBordereaux($email, $annee);
    $ligneDeFraisDAO = new ligneDeFraisDAO();
    $lignesDeFrais = $ligneDeFraisDAO->findLigneDeFrais($email);
    $motifDAO = new motifDAO();     // Appelle du DAO motifDAO
    
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Note de frais</title>
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
        <div id="texte">
            <p>Je soussigné(e)<br/>........</p>
            <p>demeurant<br/>.........</p>
            <p>certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association<br/>
            .........<br/>
            en tant que don.</p>
            <p><b>Frais de déplacement</b></p>
          
            <table class="tableBordereau">
                <tr>
                    <th class="thBordereau">Club</th>
                    <th class="thBordereau">Date</th>
                    <th class="thBordereau">Motif</th>
                    <th class="thBordereau">Trajet</th>
                    <th class="thBordereau">Kms parcourus</th>
                    <th class="thBordereau">Coût trajet</th>
                    <th class="thBordereau">Péages</th>
                    <th class="thBordereau">Repas</th>
                    <th class="thBordereau">Hébergement</th>
                    <th class="thBordereau">Total</th>
                    <?php
                    if ($bordereau->get_validite() == 0){
                        echo"<th class='thBordereauIcon'>&nbsp;</th>";
                    }
                    ?>
                </tr>
                <tr>
                <?php
                    foreach($lignesDeFrais as $ligneDeFrais){
                        
                        $idMotifs= $ligneDeFrais->get_idMotifs();
                    }
                    $motif = $motifDAO->find($idMotifs);
                    foreach($lignesDeFrais as $ligneDeFrais){
                        echo "<td></td>";
                        echo "<td>".$ligneDeFrais->get_dateFrais()."</td>";
                        echo "<td>".$motif->get_LibelleMotifs()."</td>";
                        echo "<td>".$ligneDeFrais->get_trajet()."</td>";
                        echo "<td>".$ligneDeFrais->get_km()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutTrajet()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutPeage()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutRepas()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutHebergement()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutTotal()."</td>";

                        if ($bordereau->get_validite() == 0){
                            echo '<td><a href="..\Action\edit.php?id=' . $ligneDeFrais->get_idFrais() . '"><img id="edit" src="../../ico/edit.png"/></a> '
                                . '<a href="..\Action\delete.php?id=' . $ligneDeFrais->get_idFrais() . '"><img id="delete" src="../../ico/del.png"/></a></tr>';
                        }
                    }
                ?>
                </tr>
            </table>
            <a href="../Action/ajouter.php"><img id="ajouter" src="../../ico/add.png"/> Ajouter une nouvelle ligne de frais<a>
            
            <!-- bouton valider pour valider le bordereau -->
            <div class="valider">
            <form name="Formulaire" action="bordereau.php"  method="post" class="formvalider">
                <p><input type="submit" name="submit" value="Valider le bordereau"/></p>
            </form>
            </div>

            <?php
            $submit = isset($_POST['submit']);
            if($submit == 1){
                $bordereauDAO->validerBordereau($email);
            }
            ?>

        </div>
    </section>
    <!-- End section -->

    <!-- Start footer -->
    <footer>
        <p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>                  
    </footer>
    <!-- End footer -->
                      
  </body>
</html>