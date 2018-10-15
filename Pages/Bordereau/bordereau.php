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
            <p>Je soussigné(e)</p><br/>
            <p id='frais'>.........</p><br/>
            <p>demeurant</p><br/>
            <p id='frais'>.........</p><br/>
            <p>certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association</p><br/>
            <p id='frais'>.........</p><br/>
            <p>en tant que don.</p>
            <p><b>Frais de déplacement</b></p>
          
            <table class="tableDon">
                <tr>
                    <th>Association</th>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Trajet</th>
                    <th>Kms parcourus</th>
                    <th>Coût trajet</th>
                    <th>Péages</th>
                    <th>Repas</th>
                    <th>Hébergement</th>
                    <th>Total</th>
                </tr>
                <?php
                    //foreach($rows as $row){
                    //echo "<td>$row</td> <td>$row</td> <td>$row</td> <td>$row</td> <td>$row</td> <td>$row</td> <td>$row</td> <td>$row</td> <td>$row</td> <td>$row</td>";
                    //}
                ?>
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