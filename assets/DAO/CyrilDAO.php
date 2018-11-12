<?php

class CyrilDAO{

    protected $pdo = null; // Objet de connexion

    function __construct(){
        parent::__construct();
    }

    function verify_login($mail, $mdp){
        $sql  = "SELECT AdresseMailAdh, MDPAdh, AdresseMailRespCrib, MDPRespCrib, AdresseMailRespLegal, MDPRespLegal, AdresseMailTresorier, MDPTresorier ";
        $sql .= "FROM adherent, responsable_crib, responsable_legal, tresorier ";
        $sql .= "WHERE AdresseMailAdh = :mail OR AdresseMailRespCrib = :mail OR AdresseMailRespLegal = :mail OR AdresseMailTresorier = :mail";
            try {
                $sth = $con->prepare($sql);
                $sth->execute(array(
                    ':mail' => $mail,
                    ':mdp' => $mdp
                ));
                $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }
            if (password_verify($mdp, $row['MDPAdh']) && $mail == $row["AdresseMailAdh"]) {       // Verification que le mot de passe est bien le bon
                return true;
            }else if (password_verify($mdp, $row['MDPRespCrib']) && $mail == $row["AdresseMailRespCrib"]){
                return true;
            }else if (password_verify($mdp, $row['MDPRespLegal']) && $mail == $row["AdresseMailRespLegal"]){
                return true;
            }else if (password_verify($mdp, $row['MDPTresorier']) && $mail == $row["AdresseMailTresorier"]){
                return true;
            }else{
                return false;
            }
    }
}
?>