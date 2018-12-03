<?php

class RespCribDAO extends DAO{

    // Constructeur
    function __construct(){
        parent::__construct();
    }

    // Fonction pour obtenir toutes les infos d'un adhérent
    function find($idRespCrib){
        $sql = "SELECT * FROM responsable_crib WHERE IdRespCrib= :idRespCrib";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':idRespCrib' => $idRespCrib
                ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }

            $responsable_crib = new responsable_crib($row); // Création d'un nouvel adhérent avec la classe adhérent
            return $responsable_crib; 
    }

    // Fonction pour verifier les informations de connexion
    function verify_login($mail, $mdp){
        $sql  = "SELECT AdresseMail, MDP ";
        $sql .= "FROM responsable_crib ";
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
}
?>