<?php

class bordereauDAO extends DAO {
    /**
    * Constructeur
    */
    function __construct() {
    parent::__construct();
    }   // function construct

    // function findBordereaux()
    function findAllBordereaux($numLicence) {
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

    function findBordereaux($numLicence, $annee) {
        $sql = "select * from bordereau where NumLicence= :NumLicence AND Année= :Annee";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":NumLicence" => $numLicence,
                            ":Annee" => $annee));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $bordereau = new bordereau($row);
        // Retourne l'objet métier
        return $bordereau;
    } // function findBordereaux()

    // function addBordereaux()
    function addBordereaux($numLicence) {
        $sql = "INSERT INTO bordereau(NumLicence, Année) VALUES (:NumLicence,year(CURRENT_DATE()))";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":NumLicence" => $numLicence));
        } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
    } // function findBordereaux()
} // class bordereauDAO
?>