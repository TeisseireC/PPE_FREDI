<?php
/**
* Classe DAO clubDAO
*
* @author CT
*/

class ClubDAO extends DAO {
  
  /**
  * Constructeur
  */
  function __construct() {
    parent::__construct();
  }
  
  /**
  * Lecture d'une club par son ID
  * @param type $idclub
  * @return \Club
  * @throws Exception
  */
  
  // function find()
  function find($idclub) {
    $sql = "select * from club where Idclub= :idclub";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(":idclub" => $idclub));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $club = new club($row);
    // Retourne l'objet métier
    return $club;
  }

  function findByIdClubAdh($idclub) {
    $sql = "select * from adherent where Idclub= :idclub";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(":idclub" => $idclub));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $club = new club($row);
    // Retourne l'objet métier
    return $club;
  }
  
  /**
  * Lecture de toutes les club
  * @return array
  * @throws Exception
  */

  // function findAll()
  function findAll() {
    $sql = "select * from club";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute();
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $club = array();
    foreach ($rows as $row) {
      $club[] = new club($row);
    }
    // Retourne un tableau d'objets "club"
    return $club;
  }

  function findAllByIdClubAdh($idclub) {
    $sql = "select * from adherent where Idclub= :idclub";
      try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(":idclub" => $idclub));
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $club = array();
    foreach ($rows as $row) {
      $club[] = new club($row);
    }
    // Retourne un tableau d'objets "club"
    return $club;
  }
  
  //function insert(), insere un nouveau club de frais
  function insert($idclub, $nomclub) {
    $sql = "insert into club (Idclub,nomclub) VALUES (:idclub, :nomclub);";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(
                      ":idclub" => $idclub,
                      ":nomclub" => $nomclub)
                    );
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }

  //fonction update(), modifie un prix kilometrique
  function update($idclub,$nomclub) {
    $sql = "update club set nomclub=:nomclub where Idclub=:idclub";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(
                      ":idclub" => $idclub,
                      ":nomclub" => $nomclub)
                    );
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }

  //function delete(), supprime un club de frais 
  function delete($idclub) {
    $sql = "delete from club where Idclub=:idclub";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(
                      ":idclub" => $idclub
                    ));
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }
} // Class clubDAO