<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Accueil - Responsable Crib</title>
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
        <p>Bienvenue sur le site de parametrage des bordereaux, Responsable Crib.
          Sélectionner "Tarif kilometrique" pour accéder a tous les tarifs classés par année 
          et éventuellement en ajouter, modifier ou supprimer 
          et sur "Motif de frais" pour en ajouter, modifier ou supprimer.</p>
        <form action="page_resp_crib2.php">
            <input type="submit" value="Tarif kilométrique"/>
        </form>
        <form action="page_resp_crib3.php">
            <input type="submit" value="Motifs de frais"/>
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