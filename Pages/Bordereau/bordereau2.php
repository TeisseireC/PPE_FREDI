<?php
    session_start();
    if (isset($_GET['email'])){
        $email = $_GET['email'];
    }else{
        $email = $_SESSION['email'];
    }
    
    if (isset($_GET['annee']) && isset($_GET['idBordereau'])){
        $idBordereau = $_GET['idBordereau'];
        $annee = $_GET['annee'];
    }
    
    include '../../assets/include/global.inc.php';
    $bordereauDAO = new bordereauDAO();
    $bordereau = $bordereauDAO->findBordereaux($email, date('Y'));

    $motifDAO = new motifDAO();

    $ligneDeFraisDAO = new ligneDeFraisDAO();
    $lignesDeFrais = $ligneDeFraisDAO->findLigneDeFrais($email,$idBordereau);

    $respLegalDAO = new RespLegalDAO();
    if($respLegalDAO->is_mail_exist($email) != false){
        $respLegal = $respLegalDAO->find($email);
        $infosSup = $respLegalDAO->find_infosSup($respLegal->get_idRespLegal());
        $clubDAO = new clubDAO();
        $idClub = $infosSup->get_idClub();
        $club = $clubDAO->find($idClub);
    }
    $adherentDAO = new AdherentDAO();
    if($adherentDAO->is_mail_exist($email) != false){
        $adherent = $adherentDAO->find($email);
        $clubDAO = new clubDAO();
        $idClub = $adherent->get_idClub(); 
        $club = $clubDAO->find($idClub);
        $coutTotaux = 0;
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
        <?php if($respLegalDAO->is_mail_exist($email) != false){ ?>
            <p>Je soussigné(e)<br/><?php echo $respLegal->get_prenomRespLegal()." ".$respLegal->get_nomRespLegal(); ?></p>
            <p>demeurant au<br/><?php echo $infosSup->get_adresse().", ".$infosSup->get_codePostal()." ".$infosSup->get_ville(); ?></p>
            <p>certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association<br/>
            <?php echo $club->get_nomclub(); ?><br/>
            en tant que don</p>
            <p>certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association<br/>
            en tant que don.</p>
        <?php } else if($adherentDAO->is_mail_exist($email) != false){ ?>
            <p>Je soussigné(e)<br/><?php echo $adherent->get_prenomAdh()." ".$adherent->get_nomAdh(); ?></p>
            <p>demeurant au<br/><?php echo $adherent->get_adresse().", ".$adherent->get_codePostal()." ".$adherent->get_ville(); ?></p>
            <p>certifie renoncer au remboursement des frais ci-dessous et les laisser à l'association<br/>
            <?php echo $club->get_nomclub(); ?><br/>
            en tant que don</p>
        <?php } ?>
            <p><b>Frais de déplacement</b></p>
          
            <table class="tableBordereau">
                <tr>
                    <?php if($respLegalDAO->is_mail_exist($email) != false){
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
                    if($_SESSION['role'] == "tresorier"){
                        if ($bordereau->get_validiteTresorier() == 0){
                            echo '<th class="thBordereauIcon">Action</th>';
                        }
                    }
                    ?>
                </tr>
                <tr>
                <?php
                    foreach($lignesDeFrais as $ligneDeFrais){
                        $idFrais = $ligneDeFrais->get_idFrais();
                        $motif = $motifDAO->find($idFrais);
                        echo "<tr>";
                        if($respLegalDAO->is_mail_exist($email) != false){
                            // rien n'a faire si OK
                        }else{ 
                            echo "<td>".$club->get_nomclub()."</td>";
                        }
                        echo "<td>".$ligneDeFrais->get_dateFrais()."</td>";
                        echo "<td>".$motif->get_LibelleMotifs()."</td>";
                        echo "<td>".$ligneDeFrais->get_trajet()."</td>";
                        echo "<td>".$ligneDeFrais->get_km()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutTrajet()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutPeage()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutRepas()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutHebergement()."</td>";
                        echo "<td>".$ligneDeFrais->get_coutTotal()."</td>";
                        if($_SESSION['role'] == "tresorier"){
                            if ($bordereau->get_validiteTresorier() == 0){
                                echo '<td><a href="..\Action\edit.php?id=' . $ligneDeFrais->get_idFrais() .'&amp;email='.$email.'"><img id="edit" src="../../ico/edit.png"/></a> '
                                    . '<a href="..\Action\delete.php?id=' . $ligneDeFrais->get_idFrais() .'&amp;email='.$email.'"><img id="delete" src="../../ico/del.png"/></a></td>';
                            }
                        }
                        echo '</tr>';
                        $coutTotaux = $coutTotaux + $ligneDeFrais->get_coutTotal();
                    }
                    ?>
                    <tr>
                    <td colspan='9'>&nbsp;</td>
                    <?php
                    echo "<td>".$coutTotaux."</td>";
                    echo '</tr>';

                    if ($bordereau->get_validiteTresorier() == 0){
                        if($_SESSION['role'] == "tresorier"){
                            echo "<div class='valider'>";
                            echo "<form name='Formulaire' action='bordereau2.php?annee=".$bordereau->get_annee()."&amp;idBordereau=".$bordereau->get_idBordereau()."&amp;email=".$bordereau->get_adresseMail()."' method='post' class='formvalider'>";
                                echo "<p><input type='submit' name='submit' value='Valider le bordereau'/></p>";
                            echo "</form>";
                            echo "</div>";

                            $submit = isset($_POST['submit']);
                            if($submit == 1){
                                $bordereauDAO->validerBordereauTresorier($email);
                            }
                        }
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