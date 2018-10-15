<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>PPE-G4-FREDI</title>
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
      <form action="registerRL1.php" id="registerRL1" method="post">
        <p>Nombre d'enfants<br/><input type="text" name="enfants" required/></p>
        <p><input type="submit" name="submit" value="OK" /><input type="reset" value="Réinitialiser"></p>
      </form>
    </section>
    <!-- End section --> 

    <!-- Start footer -->
    <footer>

    </footer>
    <!-- End footer -->

  </body>
</html>