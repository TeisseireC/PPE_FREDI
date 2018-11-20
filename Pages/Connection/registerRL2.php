<?php
if (isset($_POST['enfants'])){  // Si la valeur à été récupérée dans le champs caché du formulaire
    $enfants = $_POST['enfants'];   // Récupération de la valeur dans le formulaire
}else{
    $enfants = $_GET['enfants'];    // Sinon récupération de la valeur dans l'url
}
  
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
      <form action="registerRL2.php" class="formulaire" method="post">
          <?php 
            for($i=0 ; $i < intval($enfants) ; $i++){   // Nombre de champs pour le numéro de licence et le club = nombre d'enfants
              echo '<p>Numéro de licence<br/><input type="text" name="licence'.$i.'" required/>';
              echo '<select name="club" class="club">';
                    // Ici il y aura une liste déroulante des clubs
              echo '</select></p>';
            }
          ?>

          <p>Mail<br/><input type="text" name="email" required/></p>
          <p>Nom du responsable<br/><input type="text" name="nom" required/></p>
          <p>Prenom du responsable<br/><input type="text" name="prenom" required/></p>
          <p>Mot de passe<br/><input type="password" name="passe" required/></p>
          <p>Confirmation du mot de passe<br/><input type="password" name="confirm_passe" required/></p>
          <p><input type="hidden" name="enfants" value=<?php echo $enfants ?>/></p> <!-- Champ caché qui contient le nombre d'enfants -->
          <p><input type="submit" name="submit" value="OK" /><input type="reset" value="Réinitialiser"></p>

          <?php
                // Saisie des valeurs du formulaire
                $submit = isset($_POST['submit']) ? $_POST['submit'] : "";

                if ($submit) {
                    
                    $email_valide = preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $_POST['email']);   // Fonction php pour définir la syntaxe correcte d'une adresse mail

                    if ($email_valide){ //verifier si c'est un mail du type bla@bla.com

                        $email = $_POST['email'];  
                        $nom = $_POST['nom'];

                        $licences = array();    // Creation d'un tableau qui contient tout les numéros de licences
                        for ($j=0; $j<$i; $j++){
                            $licences[$j] = $_POST['licence'.$j];
                        }

                        $prenom = $_POST['prenom'];
                        $password = $_POST['passe'];
                        $password_confirm = $_POST['confirm_passe'];

                        $CSV = new CSVDAO();
                        
                        $tableau_adherent_mdp = array(); // Stockage des mot de passes hachés des adhérents à inscrire
                        $tableau_adherent_licence = array(); // Stockage des numéro de licence des adhérents à inscrire
                        $valid = true; // Variable qui permet de savoir si l'inscription est valide ou s'il y a une erreur

                        foreach ($licences as $licence){   
                            
                            $is_numLicence_exist = $CSV -> find($licence);  // Recherche de la licence dans le CSV
                            if($licence == $is_numLicence_exist){   // Si la licence est retrouvée dans le CSV 
                                $adherent = new AdherentDAO();
                                $numero_licence_exist = $adherent -> is_licence_exist($licence);  // Alors on vérifie que la licence ne soit pas déjà prise par quelqu'un de déjà inscrit
    
                                if($numero_licence_exist == false){   // Si la licence n'a pas déjà été inscrite
                                    $responsable = new RespLegalDAO(); 

                                    if(($adherent->is_mail_exist($email) == false) && ($responsable->is_mail_exist($email) == false)){  // Si l'adresse mail n'a été prise ni par un adhérent, ni par un responsable
                                        if($password == $password_confirm){ // Verification de la confirmation du mot de passe 
                                            $mdp = password_hash($password, PASSWORD_BCRYPT);  // hachage du mot de passe
                                            
                                            $tableau_adherent_mdp[]= $mdp ;
                                            $tableau_adherent_licence[] = $licence ;
                                            
                                        }else{  // Le mot de passe est différent de la confirmation du mot de passe
                                            echo '<p class="erreur">Le mot de passe que vous avez saisi est différent de la confirmation</p>';
                                            $valid = false;
                                        } 
                                    }else{  // L'email saisi appartient déjà à un autre utilisateur
                                        echo '<p class="erreur">L\'email que vous avez choisi est déjà prise par un utilisateur</p>';   
                                        $valid = false; 
                                    }
                                }else{ // Le numéro de licence saisi à déjà été pris
                                    echo '<p class="erreur">Un utilisateur possède déjà ce numéro de licence ('.$licence.', si ce numéro vous appartient, contactez votre club</p>'; 
                                    $valid = false;
                                }
                            }else{  // Le mot de passe est différent de la confirmation du mot de passe
                                echo '<p class="erreur">Le numéro de licence saisie ne correspond à aucun numéro de notre registre, si ce numéro vous appartient, contactez votre club</p>'; 
                                $valid = false;
                            } 
                        } 

                        if ($valid == true){ // Inscription de tout le monde
                            $i = 0;
                            foreach ($licences as $licence){ 
                                $adherent -> register_ADH(NULL,$tableau_adherent_mdp[$i],$tableau_adherent_licence[$i]);  // Création de l'adhérent mineur
                                $i++;
                            }
                                
                            $responsable -> register_RespLegal($email, $mdp, $nom, $prenom);    // Création du responsable légal
                            $resp = $responsable -> find($email);   // Obtention des informations du responsable légal

                            $i=0;
                            foreach ($licences as $licence){    // Pour chaques licences saisies, l'adhérent mineur se voit affecter l'id de son responsable et récupère ses informations du CSV
                                $adherent -> update_ADH($tableau_adherent_licence[$i], $resp->get_IDRespLegal());    
                                $i++;
                            }

                            isset($_SESSION) ? "" : session_start();    // Démarrage d'une session
                            $_SESSION['email'] = $email;    // Stockage de l'email dans une variable de session
                            header ("Location: ../../index.php");   // Redirection vers la page d'acceuil
                        }  
                    }else{  // L'email saisi n'est pas valide
                        echo '<p class="erreur">Adresse email invalide</p>';    
                    }
                }
            ?>
      </form>
    </section>
    <!-- End section --> 

    <!-- Start footer -->
    <footer>
        <p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>
    </footer>     
    <!-- End footer -->

  </body>
</html>