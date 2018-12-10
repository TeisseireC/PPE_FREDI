<?php

/**
 *
 * @author CT
 */
class club {

  // Attributs
  private $Idclub=0;
  private $NomClub=0;
  private $IdLigue=0;

  // Constructeur

  function __construct(array $tableau = null) {
    if ($tableau != null) {
      $this->hydrater($tableau);
    }
  }

  // Getter et setter
  
  function get_idclub() {
    return $this->Idclub;
  }

  function get_nomclub() {
    return $this->NomClub;
  }

  function get_idligue() {
    return $this->NomClub;
  }

  function set_idclub($Idclub) {
    $this->Idclub = $Idclub;
  }

  function set_nomclub($NomClub) {
    $this->NomClub = $NomClub;
  }

  function set_idligue($IdLigue) {
    $this->IdLigue = $IdLigue;
  }

  /**
   * Hydrateur
   * Alimente les propriétés à partir d'un tableau
   * @param array $tableau
   */
  function hydrater(array $tableau) {
    foreach ($tableau as $cle => $valeur) {
      $methode = 'set_' . $cle;
      if (method_exists($this, $methode)) {
        $this->$methode($valeur);
      }
    }
  }
}

// Classe Club
