<?php

class AdherentDAO extends DAO{

    // Constructeur
    function __construct(){
        parent::__construct();
    }

    // Fonction pour obtenir toutes les infos d'un adhérent
    function find($email){
        $sql = "SELECT * FROM adherent WHERE AdresseMail= :email";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':email' => $email
                ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            $adherent = new adherent($row); // Création d'un nouvel adhérent avec la classe adhérent
            return $adherent; 
    }
    
    // Fonction pour obtenir toutes les infos d'un adhérent
    function findByLicence($licence){
        $sql = "SELECT * FROM adherent WHERE numLicence= :numlicence";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':numlicence' => $licence
                ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            $adherent = new adherent($row); // Création d'un nouvel adhérent avec la classe adhérent
            return $adherent; 
    }

    function findAllByIdClub($idClub){
        $sql = "SELECT * FROM adherent WHERE idClub = :idClub";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':idClub' => $idClub
                ));
            $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            $adherents = array();
            foreach ($rows as $row) {
                $adherents[]=new Adherent($row);
            }
            return $adherents; 
    }

    // Fonction pour inscrire un adhérent
    function register_ADH($email, $mdp, $numLicence, $club){
        $sql = "INSERT into adherent (NumLicence, AdresseMail, MDP, IdClub) ";
        $sql .= "VALUES (:numLicence , :email, :mdp, :club)";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':email' => $email,
                    ':mdp' => $mdp,
                    ':numLicence' => $numLicence,
                    ":club" => $club
                ));
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }    
    }


    // Fonction pour modifier les informations d'un adhérent
    // Elle est utilisée pour récupérer les information du CSV et ajouter l'ID du reponsable légal s'il y a
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

    // Fonction pour verifier les informations de connexion
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
            if (password_verify($mdp, $row['MDP']) && $mail == $row["AdresseMail"]) {   // Verification que le mot de passe est bien le bon
                return true;    // Si tout est bon retourne vrai
            }else{
                return false;   // Si le mot de passe ou le mail est faux, retourne faux
            }
    }

    // Fonction pour qu'un adhérent ne puisse pas avoir le même mail qu'un autre utilisateur
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
            if (count($row) != 1){  // 1 car count($row) vaut 1 lorsque $row est vide
                return true ;  // Si $row contient des informations alors retourner vrai
            }else{
                return false ; // Si $row est vide alors retourner faux
            }
    }

    // Fonction pour qu'un utilisateur ne puisse pas avoir le même numéro de licence q'un autre utilisateur
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
            if (count($row) != 1 ){ // 1 car count($row) vaut 1 lorsque $row est vide
                return true ;   // Si $row contient des informations alors retourner vrai
            }else{
                return false ;  // Si $row est vide alors retourner faux
            }
    }
}
?>