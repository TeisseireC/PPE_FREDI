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
      <form action="registerRL1.php" id="registerRL1" method="GET">
        <p>Nombre d'enfants<br/><input type="text" name="enfants" required/></p>
        <p><input type="submit" name="submit" value="OK" /><input type="reset" value="Réinitialiser"></p>
      </form>

      <?php
        $submit = isset($_GET['submit']) ? $_GET['submit'] : "";

        if($submit){
          $enfants = $_GET['enfants'];  // nombre d'enfants à charge du responsable légal
          header("Location: registerRL2.php?enfants=".$enfants); // envoi du nombre d'enfants dans l'url pour la page registerRL2
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