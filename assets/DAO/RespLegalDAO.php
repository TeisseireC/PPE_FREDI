<?php

class RespLegalDAO extends DAO{

    // Constructeur
    function __construct(){
        parent::__construct();
    }

    // Fonction pour obtenir toutes les infos d'un responsable légal
    function find($email){
        $sql = "SELECT * FROM responsable_legal WHERE AdresseMail = :email ";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':email' => $email
                ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
            $responsable = new responsable($row); // Création d'un nouveau responsable légal avec la classe reponsable
            return $responsable;
    }

    // Fonction pour obtenir toutes les infos d'un responsable légal
    function findById($idResp){
        $sql = "SELECT * FROM responsable_legal WHERE IdRespLegal = :Id ";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':Id' => $idResp
                ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
            $responsable = new responsable($row); // Création d'un nouveau responsable légal avec la classe reponsable
            return $responsable;
    }

    // Fonction pour inscrire un responsable légla
    function register_RespLegal($email, $mdp, $NomRespLegal, $PrenomRespLegal){
        $sql = "INSERT into responsable_legal (NomRespLegal, PrenomRespLegal, AdresseMail, MDP) ";
        $sql .= "VALUES (:NomRespLegal,:PrenomRespLegal , :email, :mdp)";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':email' => $email,
                    ':mdp' => $mdp,
                    ':NomRespLegal' => $NomRespLegal,
                    ':PrenomRespLegal' => $PrenomRespLegal
                ));
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }    
    }

    // Fonction pour vérifier les informations de connexion d'un responsable légal
    function verify_login($mail, $mdp){
        $sql  = "SELECT AdresseMail, MDP ";
        $sql .= "FROM responsable_legal ";
        $sql .= "WHERE AdresseMail = :mail ";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':mail' => $mail
                ));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
            if (password_verify($mdp, $row['MDP']) && $mail == $row["AdresseMail"]) {       // Verification que le mot de passe est bien le bon
                return true;    // Si tout est bon retourne vrai
            }else{
                return false;   // Si le mot de passe ou le mail est faux, retourne faux
            }
    }
    
    // Fonction pour qu'un responsable légal n'est pas le même mail qu'un autre utilisateur
    function is_mail_exist($mail){
        $sql  = "SELECT * ";
        $sql .= "FROM responsable_legal ";
        $sql .= "WHERE AdresseMail = :mail ";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':mail' => $mail
                ));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
            if ($row){  // 1 car count($row) vaut 1 lorsque $row est vide
                return true ;  // Si $row contient des informations alors retourner vrai
            }else{
                return false ; // Si $row est vide alors retourner faux
            }
    }
}
?>