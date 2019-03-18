<?php
    session_start();
    $email = $_SESSION['email'];
    $annee = date('Y');

    include '../../assets/include/global.inc.php';
    $bordereauDAO = new bordereauDAO();
    $bordereau = $bordereauDAO->findBordereaux($email, date('Y'));

    if($bordereau == NULL){
        $bordereauDAO->addBordereaux($email);
        $bordereau = $bordereauDAO->findBordereaux($email, date('Y'));    
    }
    $idBordereau = $bordereau->get_idBordereau();

    $ligneDeFraisDAO = new ligneDeFraisDAO();
    $lignesDeFrais = $ligneDeFraisDAO->findLigneDeFrais($email,$idBordereau);

    $motifDAO = new motifDAO();

    $p_kmDAO = new p_kmDAO();


    if (isset($_SESSION['respLeg'])){
        $respLegalDAO = new RespLegalDAO();
        $respLegal = $respLegalDAO->find($email);
    } else {
        $adherentDAO = new AdherentDAO();
        $adherent = $adherentDAO->find($email);

        $clubDAO = new clubDAO();
        $idClub = $adherent->get_idClub(); 
        $club = $clubDAO->find($idClub);
    }

    
    
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
        <?php if(isset($_SESSION['respLeg'])){ ?>
            <p>Je soussigné(e)<br/><?php echo $respLegal->get_prenomRespLegal()." ".$respLegal->get_nomRespLegal(); ?></p>
            <p>certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association<br/>
            en tant que don.</p>
        <?php } else { ?>
            <p>Je soussigné(e)<br/><?php echo $adherent->get_prenomAdh()." ".$adherent->get_nomAdh(); ?></p>
            <p>demeurant au<br/><?php echo $adherent->get_adresse().", ".$adherent->get_codePostal()." ".$adherent->get_ville(); ?></p>
            <p>certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association<br/>
            <?php echo $club->get_nomclub(); ?><br/>
            en tant que don</p>
        <?php } ?>

            <p><b>Frais de déplacement</b></p>
          
            <table class="tableBordereau">
                <tr>
                    <?php if(isset($_SESSION['respLeg'])){
                        // ne rien faire
                    }else{ 
                        echo "<th class='thBordereau'>Club</th>";
                    } ?>
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
                <?php
                    foreach($lignesDeFrais as $ligneDeFrais){
                        $idFrais = $ligneDeFrais->get_idFrais();
                        $motif = $motifDAO->find($idFrais);
                        $p_km = $p_kmDAO->find($annee);
                        echo "<tr>";
                        if(isset($_SESSION['respLeg'])){
                            // rien n'a faire si OK
                        }else{ 
                            echo "<td>".$club->get_nomclub()."</td>";
                        }
                        $coutTrajet = $ligneDeFrais->get_km() * $p_km->get_prixKM();
                        $coutTotal = $coutTrajet + $ligneDeFrais->get_coutPeage() + $ligneDeFrais->get_coutRepas() + $ligneDeFrais->get_coutHebergement();

                        echo "<td>".$ligneDeFrais->get_dateFrais()."</td>";
                        echo "<td>".$motif->get_LibelleMotifs()."</td>";
                        echo "<td>".$ligneDeFrais->get_trajet()."</td>";
                        echo "<td>".$ligneDeFrais->get_km()."</td>";
                        echo "<td>".$coutTrajet."</td>";
                        echo "<td>".$ligneDeFrais->get_coutPeage()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutRepas()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutHebergement()."</td>";
                        echo "<td>".$coutTotal."</td>";

                        if ($bordereau->get_validite() == 0){
                            echo '<td><a href="..\Action\edit.php?id=' . $ligneDeFrais->get_idFrais() . '"><img id="edit" src="../../ico/edit.png"/></a> '
                                . '<a href="..\Action\delete.php?id=' . $ligneDeFrais->get_idFrais() . '"><img id="delete" src="../../ico/del.png"/></a></td>';
                        }
                        echo "</tr>";
                    }
                ?>
            </table>
            <?php
            if ($bordereau->get_validite() == 0){
                echo "<a href='../Action/ajouter.php'><img id='ajouter' src='../../ico/add.png'/> Ajouter une nouvelle ligne de frais<a>";
                
                //bouton valider pour valider le bordereau
                echo "<div class='valider'>";
                echo "<form name='Formulaire' action='bordereau.php' method='post' class='formvalider'>";
                    echo "<p><input type='submit' name='submit' value='Valider le bordereau'/></p>";
                echo "</form>";
                echo "</div>";
            }

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