<?php

session_start();

include "../../assets/include/global.inc.php";

// Instanciation du DAO des motif
$motifDAO = new MotifDAO();

// Récupère l'ID dans l'URL ou à défaut dans le formulaire
$idmotif = isset($_GET['idmotif']) ? $_GET['idmotif'] : $_POST['idmotif'] ;

$submit = isset($_POST['submit']);

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
    $motifDAO->update($idmotif, $libellemotif);
    header('Location: page_resp_crib3.php');
} else {
    // Formulaire non soumi
    // Récupère le salarié à modifier
    $motif = $motifDAO->findByIdMotif($idmotif);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Motif <?php echo $motif->get_IdMotifs() ?> - Modification</title>
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
<h2>Modifier le motif <?php echo $motif->get_IdMotifs() ?></h2>
<form action="#" method="post">
<p>Motif<br/><input type="text" name="libellemotif" value="<?php echo $motif->get_LibelleMotifs(); ?>"></p>
<p><input type="hidden" name="idmotif" value="<?php echo $motif->get_IdMotifs(); ?>"></p>
<p><input type="submit" name="submit" value="Modifier"></p>
</form>
<p>Retourner à la page des <a href="page_resp_crib.php" >Motifs</a></p>
</section>
<!-- End section -->

<!-- Start footer -->
<footer>
<p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>                  
</footer>
<!-- End footer -->
</body>
</html>
