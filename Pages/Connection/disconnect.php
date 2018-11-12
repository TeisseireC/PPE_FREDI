<?php       // Page de deconnexion

if (isset($_SESSION)) {
    header('location: index.php'); // Tu es passé par l'url
} else {
    // Connexion légitime
}

session_unset();            // Extinction de la session
session_destroy();          // Suppression de la session
setcookie(session_name(), '', -1, '/');    // Suppression des cookies

header('Location: ../../index.php');          // Redirection vers l'index
?>