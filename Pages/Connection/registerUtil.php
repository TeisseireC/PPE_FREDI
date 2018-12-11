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
            <!-- Début bouton pour rediriger vers la page d'inscription du responsable légal -->
            <a href="registerRL1.php" class="a_RL"> 
                <button class="button">
                    Vous êtes responsable légal ?<br/>Cliquez ici
                </button>
            </a>
            <!-- Fin du bouton -->

            <!-- Début du formulaire -->
            <form action="registerUtil.php" method="post" class="formulaire">
                <p>Numéro de licence & Club<br/><input type="text" name="licence" required>
                    <?php 
                    $clubDAO = new clubDAO();
                    $clubs = $clubDAO->findAll();

                    echo '<select name="club" class="club">';
                    foreach($clubs as $club){
                        echo '<option value='.$club->get_idclub().'>'.$club->get_nomclub().'</option>';   
                    }
                    echo '</select></p>';
                    ?>
                </p>
                <p>Email<br/><input type="text" name="email" required></p>
                <p>Mot de passe<br/><input type="password" name="password" required></p>
                <p>Confirmation du mot de passe<br/><input type="password" name="confirm_pass" required></p>      
                <p><input type="submit" name="submit" value="OK" /><input type="reset" value="Réinitialiser"></p>
            </form>
            <!-- Fin du formulaire -->

            <?php
                $submit = isset($_POST['submit']) ? $_POST['submit'] : "";

                if ($submit) {
                    
                    $email_valide = preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $_POST['email']); // Fonction php pour définir la syntaxe correcte d'une adresse mail

                    if ($email_valide){ //verifier si c'est un mail du type bla@bla.com

                        $email = $_POST['email'];   
                        $num_licence = $_POST['licence'];
                        $club = $_POST['club'];
                        $password = $_POST['password'];
                        $password_confirm = $_POST['confirm_pass'];

                        $CSV = new CSVDAO();
                        $is_numLicence_exist = $CSV -> find($num_licence);  // Recherche de la licence dans le CSV

                        if($num_licence == $is_numLicence_exist){   // Si la licence est retrouvée dans le CSV 
                            $adherent = new AdherentDAO();
                            $numero_licence_exist = $adherent -> is_licence_exist($num_licence);    // Alors on vérifie que la licence ne soit pas déjà prise par quelqu'un de déjà inscrit

                            if($numero_licence_exist == false){     // Si la licence n'a pas déjà été inscrite
                                $responsable = new RespLegalDAO();

                                if(($adherent->is_mail_exist($email) == false) && ($responsable->is_mail_exist($email) == false)){ // Si l'adresse mail n'a été prise ni par un adhérent, ni par un responsable
                                    if($password == $password_confirm){ // Verification de la confirmation du mot de passe 
                                        $mdp = password_hash($password, PASSWORD_BCRYPT);  // hachage du mot de passe

                                        $adherent -> register_ADH($email,$mdp,$num_licence, $club);    // Création d'un adhérent
                                        $adherent -> update_ADH($num_licence,NULL);     // Récupération et affecte ses données contenues dans le CSV  

                                        isset($_SESSION) ? "" : session_start();    // Demarrage d'une session
                                        $_SESSION['email'] = $email;    // Stockage du mail dans une variable de session
                                        $_SESSION['role'] = "utilisateur";  // Stockage du role
                                        header ("Location: ../../index.php");   // Redirection vers la page d'acceuil

                                    }else{  //  Le mot de passe est différent de la confirmation du mot de passe
                                        echo '<p class="erreur">Le mot de passe que vous avez saisi est différent de la confirmation</p>';
                                    } 
                                }else{  // L'email saisi appartient déjà à un autre utilisateur
                                    echo '<p class="erreur">L\'email que vous avez choisi est déjà prise par un utilisateur</p>';    
                                }
                            }else{  // Le numéro de licence saisi à déjà été pris
                                echo '<p class="erreur">Un utilisateur possède déjà ce numéro de licence, si ce numéro vous appartient, contactez votre club</p>'; 
                            }
                        }else{  // Si le mot de passe est différent de la confirmation du mot de passe
                            echo '<p class="erreur">Le numéro de licence saisie ne correspond à aucun numéro de notre registre, si ce numéro vous appartient, contactez votre club</p>'; 
                        }
                    }else{  // L'adresse mail saisi n'est pas valide
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