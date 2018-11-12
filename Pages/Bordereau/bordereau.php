<?php
    $numLicence = '170540010443';
    include '../../assets/include/global.inc.php';
    $bordereauDAO = new bordereauDAO();
    $bordereaux = $bordereauDAO->findBordereaux($numLicence);
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
                    <th class="thBordereau">Association</th>
                    <th class="thBordereau">Date</th>
                    <th class="thBordereau">Motif</th>
                    <th class="thBordereau">Trajet</th>
                    <th class="thBordereau">Kms parcourus</th>
                    <th class="thBordereau">Coût trajet</th>
                    <th class="thBordereau">Péages</th>
                    <th class="thBordereau">Repas</th>
                    <th class="thBordereau">Hébergement</th>
                    <th class="thBordereau">Total</th>
                    <th class="thBordereauIcon">&nbsp;</th>
                </tr>
                <tr>
                <?php
                    foreach($bordereaux as $bordereau){
                    echo "<td></td>";
                    echo "<td>".$bordereau->getDateFrais()."</td>";
                    echo "<td></td>";
                    echo "<td>".$bordereau->getTrajet()."</td>";
                    echo "<td>".$bordereau->getKm()."</td>";
                    echo "<td>".$bordereau->getCoutTrajet()."</td>";
                    echo "<td>".$bordereau->getCoutPeage()."</td>";
                    echo "<td>".$bordereau->getCoutRepas()."</td>";
                    echo "<td>".$bordereau->getCoutHebergement()."</td>";
                    echo "<td>".$bordereau->getCoutTotal()."</td>";
                    echo '<td><a href="edit.php?id=' . $row["id_faq"] . '"><img id="edit" src="../../ico/edit.png"/></a> '
                        . '<a href="delete.php?id=' . $row["id_faq"] . '"><img id="delete" src="../../ico/del.png"/></a></tr>';
                    }
                ?>
                </tr>
            </table>
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