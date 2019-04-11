<?php
/**
* Classe DAO MotifDAO
*
* @author CB
*/

class motifDAO extends DAO {
  
  /**
  * Constructeur
  */
  function __construct() {
    parent::__construct();
  }
  
  /**
  * Lecture d'une motif par son ID
  * @param type $idmotif
  * @return \Motif
  * @throws Exception
  */
  
  // function find()
  function find($idLigneDeFrais) {
    $sql = "select m.* from motifs m, ligne_de_frais ldf where ldf.IdMotifs = m.IdMotifs and idFrais= :idFrais";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(":idFrais" => $idLigneDeFrais));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    if ($row == NULL){
      return NULL;
  }else{
      $motif = new Motif($row);
      // Retourne l'objet métier
      return $motif;
  }
}

  // function find()
  function findByIdMotif($idMotif) {
    $sql = "select * from motifs where IdMotifs = :idMotif";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(":idMotif" => $idMotif));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    if ($row == NULL){
      return NULL;
  }else{
      $motif = new Motif($row);
      // Retourne l'objet métier
      return $motif;
  }
}

  /**
  * Lecture de toutes les motifs
  * @return array
  * @throws Exception
  */

  // function findAll()
  function findMotifs() {
    $sql = "select * from motifs";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute();
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $motifs = array();
    foreach ($rows as $row) {
      $motifs[] = new Motif($row);
    }
    // Retourne un tableau d'objets "motif"
    return $motifs;
  }
  
  //function insert(), insere un nouveau motif de frais
  function insert($idmotif, $libellemotif) {
    $sql = "insert into motifs (IdMotifs,LibelleMotifs) VALUES (:idmotif, :libellemotif);";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(
                      ":idmotif" => $idmotif,
                      ":libellemotif" => $libellemotif)
                    );
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }

  //fonction update(), modifie un prix kilometrique
  function update($idmotif,$libellemotif) {
    $sql = "update motifs set LibelleMotifs=:libellemotif where IdMotifs=:idmotif";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(
                      ":idmotif" => $idmotif,
                      ":libellemotif" => $libellemotif)
                    );
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }

  //function delete(), supprime un motif de frais 
  function delete($idmotif) {
    $sql = "delete from motifs where IdMotifs=:idmotif";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(
                      ":idmotif" => $idmotif
                    ));
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }
} // Class MotifDAO