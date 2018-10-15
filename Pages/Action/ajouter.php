<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Acceuil</title>
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
      <!-- Start formulaire -->
      <form name="Formulaire" action="ajouter.php"  method="post" class="formAjouter">
            <p>Association<br/><input type="text" name="association"></p>                        
            <p>Date<br/><input type="date" name="date"></p>
            <p>Motif<br/><select name="motif" class="motif">
                <?php
                    //foreach($rows as $row){
                    //    echo "<option>$row</option>"
                    //}
                ?>
            </select></p>
            <p>Trajets<br/><input type="text" name="trajet"></p>
            <p>Kilomètres parcourus<br/><input type="number" name="kmsParcourus"></p>
            <p>Coût des péages<br/><input type="number" name="peages"></p>
            <p>Coût des repas<br/><input type="number" name="repas"></p>
            <p>Coût de l'hébergement<br/><input type="number" name="hebergement"></p>
            <p><input type="submit" name="submit" value="Valider"/><input type="reset" name="reset" value="Réinitialiser"></p>
            
        </form>
        <!-- End formulaire -->
    </section>
    <!-- End section --> 

    <!-- Start footer -->
    <footer>
        <p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>
    </footer>
    <!-- End footer -->

  </body>
</html>