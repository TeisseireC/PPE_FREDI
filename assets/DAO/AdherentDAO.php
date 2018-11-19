<?php

class AdherentDAO extends DAO{

    function __construct(){
        parent::__construct();
    }
    function find($numLicence){
        $sql = "SELECT * FROM adherent WHERE NumLicence= :numLicence";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':numLicence' => $numLicence
                ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            $adherent = new adherent($row);
            return $adherent;  
    }

    function register_ADH($email, $mdp, $numLicence){
        $sql = "INSERT into adherent (NumLicence, AdresseMail, MDP) ";
        $sql .= "VALUES (:numLicence , :email, :mdp)";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':email' => $email,
                    ':mdp' => $mdp,
                    ':numLicence' => $numLicence
                ));
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }    
    }

    function update_ADH($numLicence, $respLegal){
        $sql = "UPDATE adherent SET Adresse = (Select adresse from csv where numLicenceCSV = :numLicence), ";
            $sql .= "CodePostal = (Select CodePostal from csv where numLicenceCSV = :numLicence), ";
            $sql .= "DateNaissance = (Select DateNaissance from csv where numLicenceCSV = :numLicence), ";
            $sql .= "NomAdh = (Select NomAdh from csv where numLicenceCSV = :numLicence), ";
            $sql .= "PrenomAdh = (Select PrenomAdh from csv where numLicenceCSV = :numLicence), ";
            $sql .= "SexeAdh = (Select SexeAdh from csv where numLicenceCSV = :numLicence), ";
            $sql .= "Ville = (Select Ville from csv where numLicenceCSV = :numLicence), ";
            $sql .= "IdRespLegal = :idResp ";
        $sql .= "WHERE NumLicence = :numLicence";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':numLicence' => $numLicence,
                    ':idResp'   => $respLegal
                ));
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
    }

    function verify_login($mail, $mdp){
        $sql  = "SELECT AdresseMail, MDP ";
        $sql .= "FROM adherent ";
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
        $sql .= "FROM adherent ";
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
            if (count($row) != 1){
                return true ;
            }else{
                return false ;
            }
    }

    function is_licence_exist($numLicence){
        $sql  = "SELECT * ";
        $sql .= "FROM adherent ";
        $sql .= "WHERE NumLicence = :numLicence ";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':numLicence' => $numLicence
                ));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
            if (count($row) != 1 ){
                return true ;
            }else{
                return false ;
            }
    }
}
?>