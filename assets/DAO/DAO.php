<?php

class DAO{

    var $pdo = null; // Objet de connexion

    function __construct(){
        $user = "root";
        $password = "";
        $host = "localhost";
        $name = "fredi";

        function executer($sql, $params = null) {
            try {
                if ($params == null) {
                    $sth = $this->pdo->query($sql); // exécution directe
                } else {
                    $sth = $this->pdo->prepare($sql); // requête préparée
                    $sth->execute($params);
                }
            } catch (PDOException $e) {
                throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage() . "\nSQL : " . $sql);
            }
            return $sth; // Renvoie le handler du résultat de la requête SQL
        }
       
        // On construit le DSN
        $dsn = 'mysql:host=' . $host . ';dbname=' . $name;

        // Création de la connexion
        try {
            $pdo = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo("<p>Erreur lors de la connexion : " . $e->getMessage().'<p>');
        }
        $this->pdo = $pdo;
    }
}
?>