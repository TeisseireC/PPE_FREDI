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
                /* Saisie des valeurs du formulaire
                $aroba = stristr($email, "@");

                if ($submit) {
                    preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#i", $_POST['email']); //verifier si c'est un mail du type bla@bla.com
                    $email = $_POST['email'];

                    $mdp = password_hash($password, PASSWORD_BCRYPT);  // hachage du mot de passe
                }
                */
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