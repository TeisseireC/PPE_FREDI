<?php
    include "../../assets/include/global.inc.php";
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Se connecter</title>
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/styles.css"/> 
    <!-- Fin Style -->
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
            
        <!-- Debut formulaire -->
        <form method="POST" action="login.php" class="formulaire">
            <p>Mail<br/><input type="text" name="id" id="id" required/></p>
            <p>Mot de passe<br/><input type="password" name="mdp" id="mdp"required/></p>
            <p><input type="submit" name="submit" value="OK" /><input type="reset" value="Réinitialiser"></p>
        </form>
        <!-- Fin formulaire -->
        
        <?php
            // Saisie des valeurs du formulaire
            $mail = isset($_POST['id']) ? $_POST['id'] : " ";
            $mdp = isset($_POST['mdp']) ? $_POST['mdp'] : " ";
            $submit = isset($_POST['submit']);

            if ($submit == 1) {
                $connectionAdh = new AdherentDAO(); 
                $connectionResp = new RespLegalDAO();
                $connectionCrib = new RespCribDAO();
                $connectionTresor = new TresorierDAO();

                if ($connectionAdh -> verify_login($mail, $mdp)){ // Verification des informations du côté des adhérents
                    session_start();    // Si tout est bon lancement d'une session
                    $_SESSION['email'] = $mail; // Stockage du mail
                    $_SESSION['role'] = "utilisateur";  // Stockage du role
                    header ("Location: ../../index.php");   // Redirection vers la page d'acceuil

                }else if($connectionResp -> verify_login($mail, $mdp)){ // Si les informations ne correspondent à aucun adhérent alors vérification du côté des responsables légaux 
                    session_start();    // Si tout est bon lancement d'une session  
                    $_SESSION['email'] = $mail; // Stockage du mail
                    $_SESSION['role'] = "utilisateur";  // Stockage du role
                    $_SESSION['respLeg'] = true;
                    header ("Location: ../../index.php");   // Redirection vers la page d'acceuil

                }else if($connectionCrib -> verify_login($mail, $mdp)){ // Si les informations ne correspondent à aucun des responsables légaux alors vérification du côté des responsables crib
                    session_start();    // Si tout est bon lancement d'une session
                    $_SESSION['email'] = $mail; // Stockage du mail
                    $_SESSION['role'] = "resp_crib";    // Stockage du role
                    header ("Location: ../../index.php");   // Redirection vers la page d'acceuil
                }
                else if($connectionTresor -> verify_login($mail, $mdp)){ // Si les informations ne correspondent à aucun des responsables crib alors vérification du côté des trésoriers
                    session_start();    // Si tout est bon lancement d'une session
                    $_SESSION['email'] = $mail; // Stockage du mail 
                    $_SESSION['role'] = "tresorier";    // Stockage du role
                    header ("Location: ../../index.php");   // Redirection vers la page d'acceuil
                }else{ // Les informations ne correspondent à aucun utilisateur 
                    echo '<p class="erreur">La saisi de votre identifiant / mot de passe est incorecte, veuillez saisir de nouveau vos informations de connection</p>';
                }

            }
        ?>

    </section>
    <!-- End section -->

    <!-- Start footer -->
    <footer>
        <p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>
    </footer>
    <!-- End footer -->
</body>
</html>