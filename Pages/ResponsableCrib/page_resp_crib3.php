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
        <h2>Bienvenue sur la page de gestion Motif de frais</h2>
        <?php
        $motifDAO = new MotifDAO();
        $motifs = $motifDAO->findMotifs();
        echo "<table>";
        echo "<tr>";
        echo "<th>IdMotif</th>";
        echo "<th>Motif de frais</th>";
        echo "<th>Modification</th>";
        echo "<th>Suppression</th>";
        echo "</tr>";
        foreach ($motifs as $motif) {
          echo "<tr>";
          echo "<td>".$motif->get_IdMotifs()."</td>";
          echo "<td>".$motif->get_LibelleMotifs()."</td>";
          echo '<td><a href=modif_resp_crib3.php?idmotif='.$motif->get_IdMotifs().'>Modifier</a></td>';
          echo '<td><a href=suppr_resp_crib3.php?idmotif='.$motif->get_IdMotifs().'>Supprimer</a></td>';
          echo "</tr>";
        }
          echo "</table>";
        
        ?>
        <form action="ajout_resp_crib3.php">
            <input type="submit" value="Ajouter un motif de frais"/>
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