<?php
if (isset($_POST['enfants'])){
    $enfants = $_POST['enfants'];
}else{
    $enfants = $_GET['enfants'];
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
            for($i=0 ; $i < intval($enfants) ; $i++){
              echo '<p>Numéro de licence<br/><input type="text" name="licence'.$i.'" required/>';
              echo '<select name="club" class="club">';
              echo '</select></p>';
            }
          ?>

          <p>Mail<br/><input type="text" name="email" required/></p>
          <p>Nom du responsable<br/><input type="text" name="nom" required/></p>
          <p>Prenom du responsable<br/><input type="text" name="prenom" required/></p>
          <p>Mot de passe<br/><input type="password" name="passe" required/></p>
          <p>Confirmation du mot de passe<br/><input type="password" name="confirm_passe" required/></p>
          <p><input type="hidden" name="enfants" value=<?php echo $enfants ?>/></p>
          <p><input type="submit" name="submit" value="OK" /><input type="reset" value="Réinitialiser"></p>

          <?php
                // Saisie des valeurs du formulaire
                
                $submit = isset($_POST['submit']) ? $_POST['submit'] : "";

                if ($submit) {
                    
                    $aroba = stristr($_POST['email'], "@");
                    $email_valide = preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $_POST['email']);

                    if ($email_valide){ //verifier si c'est un mail du type bla@bla.com

                        $email = $_POST['email'];  
                        $nom = $_POST['nom'];

                        $licences = array();
                        for ($j=0; $j<$i; $j++){
                            $licences[$j] = $_POST['licence'.$j];
                        }

                        $prenom = $_POST['prenom'];
                        $password = $_POST['passe'];
                        $password_confirm = $_POST['confirm_passe'];

                        $CSV = new CSVDAO();
                        
                        foreach ($licences as $licence){
                            $is_numLicence_exist = $CSV -> find($licence);
                            if($licence == $is_numLicence_exist){
                                $adherent = new AdherentDAO();
                                $is_numLicence_already_taken = $adherent -> find($licence);
    
                                if($licence != $is_numLicence_already_taken){
    
                                    if($password == $password_confirm){ // Verification de la confirmation du mot de passe 
                                        $mdp = password_hash($password, PASSWORD_BCRYPT);  // hachage du mot de passe
                                        
                                        $adherent -> register_ADH(NULL,$mdp,$licence);
                                        isset($_SESSION) ? "" : session_start();
                                        $_SESSION['email'] = $email;
                                        //header ("Location: ../../index.php");
  
                                    }else{
                                        echo '<p class="erreur">Le mot de passe que vous avez saisi est différent de la confirmation</p>';
                                    } 
                                }else{
                                    echo '<p class="erreur">Un utilisateur possède déjà ce numéro de licence ('.$licence.', si ce numéro vous appartient, contactez votre club</p>'; 
                                }
                            }else{
                                echo '<p class="erreur">Le numéro de licence saisie ne correspond à aucun numéro de notre registre, si ce numéro vous appartient, contactez votre club</p>'; 
                            } 
                        }  

                        $responsable = new RespLegalDAO();
                        $responsable -> register_RespLegal($email, $mdp, $nom, $prenom);
                        $resp = $responsable -> find($email);

                        foreach ($licences as $licence){
                            $adherent -> update_ADH($licence, $resp->get_IDRespLegal());
                        }
                    }else{
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