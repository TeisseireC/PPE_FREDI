<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Tarif kilométrique</title>
    <!-- Style -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/styles.css"/>
  </head>

  <body>
    <!-- Start header -->
    <header>
        <?php
          include "../../assets/include/menu2.php";
          include "../../assets/include/global.inc.php";
        ?>
    </header>
    <!-- End header -->

    <!-- Start section -->
    <section>      
        <h2>Bienvenue sur la page de gestion Tarif kilometrique</h2>
        <?php
        $p_kmDAO = new p_kmDAO();
        $p_kms = $p_kmDAO->findAll();
        echo "<table>";
        echo "<tr>";
        echo "<th>Annee</th>";
        echo "<th>Prix Kilométrique</th>";
        echo "<th>Modification</th>";
        echo "</tr>";
        foreach ($p_kms as $p_km) {
          echo "<tr>";
          echo "<td>".$p_km->get_Annee()."</td>";
          echo "<td>".$p_km->get_PrixKM()."</td>";
          echo '<td><a href=modif_resp_crib2.php?annee='.$p_km->get_Annee().'>Modifier</a></td>';
          echo "</tr>";
        }
          echo "</table>";
        
        ?>
        <form action="ajout_resp_crib2.php">
            <input type="submit" value="Ajouter un tarif kilométrique"/>
        </form>
        <form action="page_resp_crib.php">
            <input type="submit" value="Page précédente"/>
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