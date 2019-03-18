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
  * Lecture d'une p_km par Annee
  * @param type $id_p_km
  * @return \p_km
  * @throws Exception
  */
  
  // function find()
  function find($annee) {
    $sql = "select * from p_km where Annee=:annee";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(":annee" => $annee));
      $row = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
    if ($row == NULL){
      return NULL;
    }else{
      $p_km = new P_km($row);
      // Retourne l'objet métier
      return $p_km;
  }
}

  /**
  * Lecture de toutes les p_kms
  * @return array
  * @throws Exception
  */
  
  // function findAll()
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
  }
  
  //function insert(), insere un nouveau prix kilometrique
  function insert($annee, $prixkm) {
    $sql = "insert into p_km (Annee,PrixKM) VALUES (:annee, :prixkm);";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(
        ":annee" => $annee,
        ":prixkm" => $prixkm)
      );
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }
  
  //function update(), modifie un prix kilometrique
  function update($annee,$prixkm) {
    $sql = "update p_km set prixkm=:prixkm where Annee=:annee";
    try {
      $sth = $this->pdo->prepare($sql);
      $sth->execute(array(
        ":annee" => $annee,
        ":prixkm" => $prixkm)
      );
    } catch (PDOException $e) {
      throw new Exception("Erreur lors de la requête SQL : " . $e->getMessage());
    }
  }
  
} // Class p_kmDAO