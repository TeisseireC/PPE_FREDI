<?php

class RespLegalDAO extends DAO{

    function __construct(){
        parent::__construct();
    }

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
            $responsable = new responsable($row);
            return $responsable;
    }

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
                return true;
            }else{
                return false;
            }
    }
    
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
            if (count($row) !=1 ){
                return true ;
            }else{
                return false ;
            }
    }
}
?>