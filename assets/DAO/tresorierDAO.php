<?php

class TresorierDAO extends DAO{
    
    function __construct(){
        parent::__construct();
    }
    
    function insert(Tresorier $tresorier) {
        $sql = "INSERT INTO tresorier (nomTresorier, prenomTresorier) ";
        $sql .="VALUES (:marque, :modele)";
        $params = array(
            ":nomTresorier" => $tresorier->get_nomTresorier(),
            ":prenomTresorier" => $tresorier->get_prenomTresorier()
        );
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
        return $nb; // Retourne le nombre de mise à jour
    }
    
    function update(Tresorier $tresorier) {
        $sql = "UPDATE tresorier SET nomTresorier=:nomTresorier, prenomTresorier=:prenomTresorier WHERE idTresorier=:idTresorier";
        $params = array(
            ":idTresorier" => $tresorier->get_idTresorier(),
            ":nomtresorier" => $tresorier->get_nomTresorier(),
            ":prenomTresorier" => $tresorier->get_prenomTresorier()
        );
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
        return $nb;
    }
    
    function delete($tresorier) {
        $sql = "DELETE FROM tresorier WHERE idTresorier=:idTresorier";
        $params = array(
            ":idTresorier" => $tresorier->get_idTresorier()
        );
        $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
        $nb = $sth->rowcount();
        return $nb; // Retourne le nombre de mise à jour
    }
    
    function find($idTresorier) {
        $sql = "SELECT * FROM tresorier WHERE idTresorier= :idTresorier";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(":idTresorier" => $idTresorier));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
        }
        $idTresorier = new FrediDAO($row);
        // Retourne l'objet métier
        return $idTresorier;
    } // function find()

    // Fonction pour verifier les informations de connexion
    function verify_login($mail, $mdp){
    $sql  = "SELECT AdresseMail, MDP ";
    $sql .= "FROM tresorier ";
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
    


function findAll() {
    $sql = "SELECT * FROM tresorier";
    try {
        $sth = $this->pdo->prepare($sql);
        $sth->execute();
        $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $tresorier = array();
    foreach ($rows as $row) {
        $tresorier[] = new Tresorier($row);
    }
    // Retourne un tableau d'objets "tresorier"
    return $tresorier;
}

function findAllByMail($adresseMail){
    $sql = "SELECT * FROM tresorier WHERE adresseMail= :adresseMail";
        try {
            $sth = $this->pdo->prepare($sql);
            $sth->execute(array(
                ':adresseMail' => $adresseMail
            ));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $ex) {
            die("Erreur lors de la requête SQL : " . $ex->getMessage());
        }

        $tresorier = new Tresorier($row); // Renvoi les informations du trésorier dans la classe Trésorier.php
        return $tresorier; 
}

}
?>