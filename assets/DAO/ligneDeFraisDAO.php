<?php
class ligneDeFraisDAO extends DAO {
    /**
    * Constructeur
    */
    function __construct() {
    parent::__construct();
    }   // function construct

    // function findLigneDeFrais()
    function findLigneDeFrais($email) {
        $sql = "select * from ligne_de_frais ldf, bordereau b where b.IdBordereau = ldf.IdBordereau AND AdresseMail= :email";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":email" => $email));
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
    }

    // function findLigneDeFraisById()
    function findLigneDeFraisById($idFrais) {
        $sql = "select * from ligne_de_frais where idFrais= :idFrais";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":idFrais" => $idFrais));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $ligne = new ligneDeFrais($row);
        // Retourne l'objet métier
        return $ligne;
    }

    // function updateLigneDeFrais
    function updateLigneDeFrais($IDFrais, $dateFrais, $trajet, $km, $coutTrajet, $coutPeage, $coutRepas, $coutHebergement){
        $sql = "update ligne_de_frais set";
        $sql .=" DateFrais= :dateFrais, Trajet= :trajet, Km= :km, CoutTrajet= :coutTrajet, CoutPeage= :coutPeage, CoutRepas= :coutRepas, CoutHebergement= :coutHebergement";
        $sql .=" where IdFrais=:idFrais";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(":idFrais" => $IDFrais,
                                ":dateFrais" => $dateFrais,
                                ":trajet" => $trajet,
                                ":km" => $km, 
                                ":coutTrajet" => $coutTrajet,
                                ":coutPeage" => $coutPeage, 
                                ":coutRepas" => $coutRepas, 
                                ":coutHebergement" => $coutHebergement));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
    }

    // function insertLigneDeFrais
    function insertLigneDeFrais($dateFrais, $trajet, $km, $coutTrajet, $coutPeage, $coutRepas, $coutHebergement, $idBordereau, $motifFrais) {
        $sql = "Insert into ligne_de_frais(DateFrais, Trajet, Km, CoutTrajet, CoutPeage, CoutRepas, CoutHebergement, idBordereau, IdMotifs)";
        $sql .= "VALUES (:dateFrais, :trajet, :km, :coutTrajet, :coutPeage, :coutRepas, :coutHebergement, :idBordereau, :motifFrais)";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(":dateFrais" => $dateFrais,
                                ":trajet" => $trajet,
                                ":km" => $km, 
                                ":coutTrajet" => $coutTrajet,
                                ":coutPeage" => $coutPeage, 
                                ":coutRepas" => $coutRepas, 
                                ":coutHebergement" => $coutHebergement,
                                ":idBordereau" => $idBordereau,
                                ":motifFrais" => $motifFrais));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
    }

    // function deleteLigneDeFrais
    function deleteLigneDeFrais($IDFrais) {
        $sql = "delete FROM ligne_de_frais WHERE IDFrais=:IDFrais";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(":IDFrais" => $IDFrais));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
    }
}
?>