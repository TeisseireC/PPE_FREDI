<?php
include "include/global.inc.php";

// Récupère le token s'il existe
$token = isset($_GET['token']) ? $_GET['token'] : NULL;
// Récupère les paramètres de connexion s'ils existent
$user = isset($_GET["user"]) ? $_GET["user"] : "";
$password = isset($_GET["password"]) ? $_GET["password"] : "";

// Authentification avec token
// S'il existe, cherche le token dans le fichier des tokens
$authentifie = FALSE;
if ($token) {
  $tokens = get_tokens();  // Lit le fichier des tokens
  if (in_array($token, $tokens)) {
    $authentifie = TRUE;
  }
}

// Authentification sans token
// S'ils existent, cherche le user et le mot de passe
if (isset($users[$user]) && $password == $users[$user]) {
  $authentifie = TRUE;
  // Crée un token aléatoire (<PHP7)
  $token = bin2hex(openssl_random_pseudo_bytes(15));
  // Ajoute le token au fichier des tokens
  add_token($token);
}

  $bordereauDAO = new bordereauDAO;
  $bordereaux = $bordereauDAO->findCurrentYear();
  $lignesDeFraisDAO = new ligneDeFraisDAO;
  $motifDAO = new motifDAO();

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
    $tableau_bordereaux[] = array(
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