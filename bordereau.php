<?php
include "include/global.inc.php";

// Saisie des valeurs du formulaire
$mail = isset($_GET["user"]) ? $_GET["user"] : "";
$mdp = isset($_GET["password"]) ? $_GET["password"] : "";

$bordereauDAO = new bordereauDAO;
$lignesDeFraisDAO = new ligneDeFraisDAO;
$motifDAO = new motifDAO();

$bordereaux = $bordereauDAO->findAllBordereaux($mail);  
  
foreach($bordereaux as $bordereau){
  $tableau_ldf = array(); // remise a 0 du tableau
  $lignesDeFrais = $lignesDeFraisDAO->findLigneDeFraisByYear($bordereau->get_idBordereau(), $bordereau->get_annee());
  // var_dump($lignesDeFrais);
    foreach($lignesDeFrais as $ligneDeFrais){
      $motif = $motifDAO->find($ligneDeFrais->get_idFrais());
      $tableau_ldf[] = array(
            "IdLigneDeFrais"=>$ligneDeFrais->get_idFrais(),
            "DateLigneDeFrais"=>$ligneDeFrais->get_dateFrais(),
            "Trajet"=>$ligneDeFrais->get_trajet(),
            "Kilomètres"=>$ligneDeFrais->get_km(),
            "CoutTrajet"=>$ligneDeFrais->get_coutTrajet(),
            "CoutPeage"=>$ligneDeFrais->get_coutPeage(),
            "CoutRepas"=>$ligneDeFrais->get_coutRepas(),
            "CoutHebergement"=>$ligneDeFrais->get_coutHebergement(),
            "CoutTotal"=>$ligneDeFrais->get_coutTotal(),
            "Motif"=>$motif->get_LibelleMotifs()
          );
      }
  $tableau_bordereaux = array(
      "IdBordereau"=>$bordereau->get_idBordereau(),
      "Annee"=>$bordereau->get_annee(),
      "AdresseMail"=>$bordereau->get_adresseMail(),
      "LigneDeFrais"=>$tableau_ldf
  );
}

header("Content-type: application/json; charset=utf-8");
$json=json_encode($tableau_bordereaux);
echo $json;
?>