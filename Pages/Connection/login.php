<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Se connecter</title>
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
                if(connecter){
                    sessions_start();
                    $_SESSION['id_session'] = $mail;
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