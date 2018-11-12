<?php
/**
* Classe DAO OfficeDAO
*
* @author CB
*/

class OfficeDAO extends DAO {
  
  /**
  * Constructeur
  */
  function __construct() {
    parent::__construct();
  }
  
  /**
  * Lecture d'une office par son ID
  * @param type $id_office
  * @return \Office
  * @throws Exception
  */
  
  function find($id_office) {
    $sql = "select * from offices where officeCode= :officeCode";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(":officeCode" => $id_office));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $office = new Office($row);
    // Retourne l'objet métier
    return $office;
  } // function find()
  
  /**
  * Lecture de toutes les offices
  * @return array
  * @throws Exception
  */
  function findAll() {
    $sql = "select * from offices";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute();
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $offices = array();
    foreach ($rows as $row) {
      $offices[] = new Office($row);
    }
    // Retourne un tableau d'objets "office"
    return $offices;
  } // function findAll()
  
  /*
  function update(office $office) {
    $sql = "update office set city=:city,phone=:phone where id= :id";
    $params = array(
      ":id" => $office->get_id(),
      ":city" => $office->get_city(),
      ":phone" => $office->get_phone()
    );
    $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
    $nb = $sth->rowcount();
    return $nb;  // Retourne le nombre de mise à jour
  } // update()
  */

} // Class OfficeDAO