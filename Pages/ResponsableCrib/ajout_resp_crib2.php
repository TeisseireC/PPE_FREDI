<?php

session_start();

include "../../assets/include/global.inc.php";

// Instanciation du DAO des p_km
$p_kmDAO = new P_kmDAO();

$submit = isset($_POST['submit']) ? $_POST['submit'] : '';

if ($submit) {
    // Formulaire soumi
    // Récupère les données du formulaire
    $annee = isset($_POST['annee']) ? $_POST['annee'] : '';
    $prixkm = isset($_POST['prixkm']) ? $_POST['prixkm'] : '';
    
    $p_km = new p_kmDAO(); // array(
        /*'annee'=>$annee,
        'prixkm'=>$prixkm 
    ));*/
    // Modifie l'enregistrement dans la BD
    $p_kmDAO->insert($annee, $prixkm);
    header('Location: page_resp_crib2.php');
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Tarif km - Ajout</title>
<link rel="stylesheet" type="text/css" href="../../assets/css/styles.css"/>
</head>
<body>
<!-- Start header -->
<header>
<?php include "../../assets/include/menu2.php"; ?>
</header>
<!-- End header -->

<!-- Start section -->
<section>
<h2>Ajouter un tarif kilométrique</h2>
<form action="#" method="post">
<p>Annee:<br/><input type="text" name="annee" value=""></p>
<p>Tarif kilométrique:<br/><input type="text" name="prixkm" value=""></p>
<br/>
<p><input type="submit" name="submit" value="Ajouter"></p>
</form>
<br/>
<form action="page_resp_crib2.php">
    <input type="submit" value="Retour"/>
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
