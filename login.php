<?php
//
// top14server - Serveur web service RESTful
//
// Authentifie un client Android et renvoie une réponse JSON
// Exemple : http://localhost/projets/top14server/login.php?user=jef&password=jefjef
include "include/global.inc.php";

// Saisie des valeurs du formulaire
$mail = isset($_GET["user"]) ? $_GET["user"] : "";
$mdp = isset($_GET["password"]) ? $_GET["password"] : "";

$connectionAdh = new AdherentDAO(); 
$connectionResp = new RespLegalDAO();

if ($connectionAdh -> verify_login($mail, $mdp)){ // Verification des informations du côté des adhérents
    session_start();    // Si tout est bon lancement d'une session
    $_SESSION['email'] = $mail; // Stockage du mail
    $_SESSION['role'] = "utilisateur";  // Stockage du role
    $message = "user authentifié";

}else if($connectionResp -> verify_login($mail, $mdp)){ // Si les informations ne correspondent à aucun adhérent alors vérification du côté des responsables légaux 
    session_start();    // Si tout est bon lancement d'une session  
    $_SESSION['email'] = $mail; // Stockage du mail
    $_SESSION['role'] = "utilisateur";  // Stockage du role
    $_SESSION['respLeg'] = true;
    $message = "user authentifié";

}else{ // Les informations ne correspondent à aucun utilisateur 
    $message = "user non authentifié";
}
  
// Construit le format JSON
$json = build_json($message, $token, NULL);
// Envoie la réponse 
send_json($json);