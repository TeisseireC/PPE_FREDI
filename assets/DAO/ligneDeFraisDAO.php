<?php
class ligneDeFraisDAO extends DAO {
    /**
    * Constructeur
    */
    function __construct() {
    parent::__construct();
    }   // function construct

    // function findLigneDeFrais()
    function findLigneDeFrais($IDBordereau) {
        $sql = "select * from ligne_de_frais, bordereau where ligne_de_frais.IdBordereau = dordereau.IdBordereau AND IdBordereau =:IDBordereau";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":IDBordereau" => $IDBordereau));
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $lignes = array();
        foreach ($rows as $row) {
        $lignes[] = new ligneDeFrais($row);
        }
        // Retourne l'objet métier
        return $lignes;
    } // function findLigneDeFrais()
} // class LigneDeFraisDAO
?>