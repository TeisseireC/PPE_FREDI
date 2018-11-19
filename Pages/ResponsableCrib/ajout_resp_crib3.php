<?php

include "../../assets/include/global.inc.php";

// Instanciation du DAO des motif
$motifDAO = new MotifDAO();

$submit = isset($_POST['submit']) ? $_POST['submit'] : '';

if ($submit) {
    // Formulaire soumi
    // Récupère les données du formulaire
    $idmotif = isset($_POST['idmotif']) ? $_POST['idmotif'] : '';
    $libellemotif = isset($_POST['libellemotif']) ? $_POST['libellemotif'] : '';
    
    $motif = new motifDAO(); // array(
        /*'idmotif'=>$idmotif,
        'libellemotif'=>$libellemotif 
    ));*/
    // Modifie l'enregistrement dans la BD
    $motifDAO->insert($idmotif, $libellemotif);
    header('Location: page_resp_crib3.php');
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
<h2>Ajouter un motif  de frais</h2>
<form action="#" method="post">
<p><input type="hidden" name="idmotif" value="NULL"></p>
<p>Motif de frais:<br/><input type="text" name="libellemotif" value=""></p>
<p><input type="submit" name="submit" value="Ajouter"></p>
</form>
<form action="page_resp_crib3.php">
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
