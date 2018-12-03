<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">

    <title>Liste des bordereaux</title>
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
        <h2>Bienvenue sur la liste des bordereaux des adhérents</h2>
        <?php
        $email = "???";
        $bordereauDAO = new bordereauDAO();
        $bordereaux = $bordereauDAO->findAllBordereaux($email);
        echo "<table>";
        echo "<tr>";
        echo "<th>Année</th>";
        echo "<th>Numéro bordereau</th>";
        echo "<th>Adresse Mail";
        echo "</tr>";
        foreach ($bordereaux as $bordereau) {
          echo "<tr>";
          echo "<td>".$bordereau->get_annee()."</td>";
          echo '<td><a href=../Bordereau/bordereau.php?idBordereau='.$bordereau->get_idBordereau().'> '.$bordereau->get_idBordereau(). '</td>';
          echo '<td>'.$bordereau->get_adresseMail().'>Modifier</a></td>';
          echo "</tr>";
        }
          echo "</table>";
        
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