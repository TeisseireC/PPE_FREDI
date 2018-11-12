<?php

class bordereauDAO extends DAO {
    /**
    * Constructeur
    */
    function __construct() {
    parent::__construct();
    }   // function construct

    // function findBordereaux()
    function findBordereaux($numLicence) {
        $sql = "select * from bordereau where NumLicence= :NumLicence";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":NumLicence" => $numLicence));
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $bordereaux = array();
        foreach ($rows as $row) {
        $bordereaux[] = new Bordereau($row);
        }
        // Retourne l'objet métier
        return $bordereaux;
    } // function findBordereaux()
} // class bordereauDAO
?>