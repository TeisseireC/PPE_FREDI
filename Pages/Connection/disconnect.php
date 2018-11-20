<?php      

session_unset();            // Extinction de la session
session_destroy();          // Suppression de la session
setcookie(session_name(), '', -1, '/');    // Suppression des cookies

header('Location: ../../index.php');          // Redirection vers l'index
?>