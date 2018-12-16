<?php

include "../../assets/include/global.inc.php";

// Instanciation du DAO des p_km
$p_kmDAO = new P_kmDAO();

// Récupère l'ID dans l'URL ou à défaut dans le formulaire
$annee = isset($_GET['annee']) ? $_GET['annee'] : $_POST['annee'] ;

$submit = isset($_POST['submit']);

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
    $p_kmDAO->update($annee, $prixkm);
    header('Location: page_resp_crib2.php');
} else {
    // Formulaire non soumi
    // Récupère le salarié à modifier
    $p_km = $p_kmDAO->find($annee);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Tarif km <?php echo $p_km->get_Annee() ?> - Modification</title>
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
<h2>Modifier le tarif kilométrique de l'Annee <?php echo $p_km->get_Annee() ?></h2>
<form action="#" method="post">
<p>Tarif kilométrique<br/><input type="text" name="prixkm" value="<?php echo $p_km->get_PrixKM(); ?>"></p>
<p><input type="hidden" name="annee" value="<?php echo $p_km->get_Annee(); ?>"></p>
<br/>
<p><input type="submit" name="submit" value="Modifier"></p>
</form>
<br/>
<p>Retourner à la page des <a href="page_resp_crib.php" >tarifs kilométrique</a></p>
</section>
<!-- End section -->

<!-- Start footer -->
<footer>
<p>Site développé par Clément Bonnefont, Cyril Teisseire, Antoine Vucic et Yann Cecconato</p>                  
</footer>
<!-- End footer -->
</body>
</html>
