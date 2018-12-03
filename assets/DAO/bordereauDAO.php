<?php

class bordereauDAO extends DAO {
    /**
    * Constructeur
    */
    function __construct() {
    parent::__construct();
    }   // function construct

    // function findBordereaux()
    function findAllBordereaux($email) {
        $sql = "select * from bordereau where AdresseMail= :email";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":email" => $email));
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

    function findBordereaux($email, $annee) {
        $sql = "select * from bordereau where AdresseMail= :email AND Année= :Annee";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":email" => $email,
                            ":Annee" => $annee));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        if ($row == NULL){
            return NULL;
        }else{
            $bordereau = new Bordereau($row);
            // Retourne l'objet métier
            return $bordereau;
        }
    } // function findBordereaux()

    // function addBordereaux()
    function addBordereaux($email) {
        $sql = "INSERT INTO bordereau(AdresseMail, Année) VALUES (:email,year(CURRENT_DATE()))";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":email" => $email));
        } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
    } // function findBordereaux()
} // class bordereauDAO
?>