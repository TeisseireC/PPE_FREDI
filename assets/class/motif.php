<?php

/**
 * Classe P_km
 *
 * @author CB
 */
class Motif {

  // Attributs
  private $IdMotifs=0;
  private $LibelleMotifs=0;

  // Constructeur

  function __construct(array $tableau = null) {
    if ($tableau != null) {
      $this->hydrater($tableau);
    }
  }

  // Getter et setter
  
  function get_idMotifs() {
    return $this->IdMotifs;
  }

  function get_libelleMotifs() {
    return $this->LibelleMotifs;
  }

  function set_idMotifs($IdMotifs) {
    $this->IdMotifs = $IdMotifs;
  }

  function set_libelleMotifs($LibelleMotifs) {
    $this->LibelleMotifs = $LibelleMotifs;
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

// Classe P_km
