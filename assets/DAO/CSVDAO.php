<?php

class CSVDAO extends DAO{

    function __construct(){
        parent::__construct();
    }

    function find($numLicence){
        $sql = "SELECT NumLicenceCSV FROM CSV WHERE NumLicenceCSV = :numLicence";
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