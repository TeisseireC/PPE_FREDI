<?php

class CSVDAO extends DAO{
    
    // Constructeur
    function __construct(){
        parent::__construct();
    }

    // Fonction pour savoir si le numéro de licence saisi existe dans le CSV
    function find($numLicence){
        $sql = "SELECT NumLicenceCSV FROM csv WHERE NumLicenceCSV = :numLicence";
            try {
                $sth = $this->pdo->prepare($sql);
                $sth->execute(array(
                    ':numLicence' => $numLicence
                ));
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $ex) {
                die("Erreur lors de la requête SQL : " . $ex->getMessage());
            }    
        return $row['NumLicenceCSV'];
    }
}
?>