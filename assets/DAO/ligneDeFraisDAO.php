<?php
class ligneDeFraisDAO extends DAO {
    /**
    * Constructeur
    */
    function __construct() {
    parent::__construct();
    }   // function construct

    // function findLigneDeFrais()
    function findLigneDeFrais($email,$idBordereau) {
        $sql = "select * from ligne_de_frais ldf, bordereau b where b.IdBordereau = ldf.IdBordereau AND b.IdBordereau = :idBordereau AND AdresseMail= :email";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":email" => $email,
                            ":idBordereau" => $idBordereau
                            ));
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

    // function findLigneDeFraisByYear()
    function findLigneDeFraisByYear($idBordereau,$annee){
        $sql = "select LF.* from ligne_de_frais LF , bordereau B where LF.IdBordereau = B.IdBordereau And B.IdBordereau = :idBordereau And B.Annee = :annee";
        try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array(":idBordereau" => $idBordereau,
                            ":annee" => $annee
                            ));
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

    // function updateLigneDeFrais
    function updateLigneDeFrais($IDFrais, $dateFrais, $trajet, $km, $coutTrajet, $coutPeage, $coutRepas, $coutHebergement , $motif, $coutTotal){
        $sql = "update ligne_de_frais set";
        $sql .=" DateFrais= :dateFrais, Trajet= :trajet, Km= :km, CoutTrajet= :coutTrajet, CoutPeage= :coutPeage, CoutRepas= :coutRepas, CoutHebergement= :coutHebergement, CoutTotal= :coutTotal, idMotifs = :motif";
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
                                ":coutHebergement" => $coutHebergement,
                                ":coutTotal" => $coutTotal,
                                ":motif" => $motif));
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
    }

    // function insertLigneDeFrais
    function insertLigneDeFrais($dateFrais, $trajet, $km, $coutTrajet, $coutPeage, $coutRepas, $coutHebergement, $idBordereau, $motifFrais, $coutTotal) {
        $sql = "Insert into ligne_de_frais(DateFrais, Trajet, Km, CoutTrajet, CoutPeage, CoutRepas, CoutHebergement, CoutTotal, idBordereau, IdMotifs)";
        $sql .= "VALUES (:dateFrais, :trajet, :km, :coutTrajet, :coutPeage, :coutRepas, :coutHebergement, :coutTotal, :idBordereau, :motifFrais)";
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
                                ":motifFrais" => $motifFrais,
                                ":coutTotal" => $coutTotal ));
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