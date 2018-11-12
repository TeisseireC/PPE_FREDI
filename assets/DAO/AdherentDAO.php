<?php

class AdherentDAO extends DAO{

    function __construct(){
        parent::__construct();
    }
    function find($numLicence){
        $sql = "SELECT NumLicence FROM adherent WHERE NumLicence= :numLicence";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':numLicence' => $numLicence
                ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
        return $row['NumLicence'];    
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

    function update_ADH($numLicence){
        $sql = "UPDATE adherent SET Adresse = (Select adresse from csv where numLicenceCSV = :numLicence), ";
            $sql .= "CodePostal = (Select CodePostal from csv where numLicenceCSV = :numLicence), ";
            $sql .= "DateNaissance = (Select DateNaissance from csv where numLicenceCSV = :numLicence), ";
            $sql .= "NomAdh = (Select NomAdh from csv where numLicenceCSV = :numLicence), ";
            $sql .= "PrenomAdh = (Select PrenomAdh from csv where numLicenceCSV = :numLicence), ";
            $sql .= "SexeAdh = (Select SexeAdh from csv where numLicenceCSV = :numLicence), ";
            $sql .= "Ville = (Select Ville from csv where numLicenceCSV = :numLicence) ";
        $sql .= "WHERE NumLicence = :numLicence";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':numLicence' => $numLicence
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
}
?>