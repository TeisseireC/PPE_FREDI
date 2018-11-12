<?php
/**
* Classe DAO p_kmDAO
*
* @author CB
*/

class p_kmDAO extends DAO {
  
  /**
  * Constructeur
  */
  function __construct() {
    parent::__construct();
  }
  
  /**
  * Lecture d'une p_km par son ID
  * @param type $id_p_km
  * @return \p_km
  * @throws Exception
  */
  
  function find($id_p_km) {
    $sql = "select * from p_kms where p_kmCode= :p_kmCode";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(":p_kmCode" => $id_p_km));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $p_km = new p_km($row);
    // Retourne l'objet métier
    return $p_km;
  } // function find()
  
  /**
  * Lecture de toutes les p_kms
  * @return array
  * @throws Exception
  */
  function findAll() {
    $sql = "select * from p_km";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute();
      $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    $p_kms = array();
    foreach ($rows as $row) {
      $p_kms[] = new p_km($row);
    }
    // Retourne un tableau d'objets "p_km"
    return $p_kms;
  } // function findAll()
  
  /*
  function update(p_km $p_km) {
    $sql = "update p_km set city=:city,phone=:phone where id= :id";
    $params = array(
      ":id" => $p_km->get_id(),
      ":city" => $p_km->get_city(),
      ":phone" => $p_km->get_phone()
    );
    $sth = $this->executer($sql, $params); // On passe par la méthode de la classe mère
    $nb = $sth->rowcount();
    return $nb;  // Retourne le nombre de mise à jour
  } // update()
  */

} // Class p_kmDAO