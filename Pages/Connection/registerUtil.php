<?php
    include "../../assets/include/global.inc.php";
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">

        <title>S'inscrire</title>
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
            <a href="registerRL1.php" class="a_RL">
                <button class="button">
                    Vous êtes responsable légal ?<br/>Cliquez ici
                </button>
            </a>

            <form action="registerUtil.php" method="post" class="formulaire">
                <p>N° licence<br/><input type="text" name="licence" required></p>
                <p>Email<br/><input type="text" name="email" required></p>
                <p>Mot de passe<br/><input type="password" name="password" required></p>
                <p>Confirmation du mot de passe<br/><input type="password" name="confirm_pass" required></p>      
                <p><input type="submit" name="submit" value="OK" /><input type="reset" value="Réinitialiser"></p>
            </form>
            
            <?php
                // Saisie des valeurs du formulaire
                
                $submit = isset($_POST['submit']) ? $_POST['submit'] : "";

                if ($submit) {
                    
                    $aroba = stristr($_POST['email'], "@");
                    $email_valide = preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $_POST['email']);

                    if ($email_valide){ //verifier si c'est un mail du type bla@bla.com

                        $email = $_POST['email'];   
                        $num_licence = $_POST['licence'];
                        $password = $_POST['password'];
                        $password_confirm = $_POST['confirm_pass'];

                        $CSV = new CSVDAO();
                        $is_numLicence_exist = $CSV -> find($num_licence);

                        if($num_licence == $is_numLicence_exist){
                            $adherent = new AdherentDAO();
                            $is_numLicence_already_taken = $adherent -> find($num_licence);

                            if($num_licence != $is_numLicence_already_taken){

                                if($password == $password_confirm){ // Verification de la confirmation du mot de passe 
                                    $mdp = password_hash($password, PASSWORD_BCRYPT);  // hachage du mot de passe
                                    
                                    $adherent -> register_ADH($email,$mdp,$num_licence);
                                    $adherent -> update_ADH($num_licence);
                                    
                                    session_start();
                                    $_SESSION['email'] = $email;
                                    header ("Location: ../../index.php");
                                }else{
                                    echo '<p class="erreur">Le mot de passe que vous avez saisi est différent de la confirmation</p>';
                                } 
                            }else{
                                echo '<p class="erreur">Un utilisateur possède déjà ce numéro de licence, si ce numéro vous appartient, contactez votre club</p>';  
                            }
                        }else{
                            echo '<p class="erreur">Le numéro de licence saisie ne correspond à aucun numéro de notre registre, si ce numéro vous appartient, contactez votre club</p>'; 
                            echo '<p>'.$num_licence.'</p>';
                            echo '<p>'.$CSV -> find($num_licence).'</p>';
                        }
                    }else{
                        echo '<p class="erreur">Adresse email invalide</p>';    
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