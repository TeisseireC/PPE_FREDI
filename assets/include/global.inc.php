<?php

/**
 * Paramétrage pour certains serveurs qui n'affichent pas les erreurs PHP par défaut
 */
ini_set('display_errors', '1');
ini_set('html_errors', '1');

/**
 * Autoload
 * @param string $classe
 */
function my_autoloaderDAO($classe) {
  if (file_exists('../../assets/DAO/' . $classe . '.php')){
    include '../../assets/DAO/' . $classe . '.php';
  }
}

function my_autoloaderClass($classe) {
  if (file_exists('../../assets/class/' . $classe . '.php')){
    include '../../assets/class/' . $classe . '.php';
  }
}

spl_autoload_register('my_autoloaderDAO');
spl_autoload_register('my_autoloaderClass');

/**
 * Vide le cache du navigateur
 */
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");


?>