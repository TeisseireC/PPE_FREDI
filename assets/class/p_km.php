<?php

/**
 * Classe P_km
 *
 * @author CB
 */
class P_km {

  // Attributs
  private $Année=0;
  private $PrixKM=0;

  // Constructeur

  function __construct(array $tableau = null) {
    if ($tableau != null) {
      $this->hydrater($tableau);
    }
  }

  // Getter et setter
  
  function get_année() {
    return $this->Année;
  }

  function get_prixKM() {
    return $this->PrixKM;
  }

  function set_année($Année) {
    $this->Année = $Année;
  }

  function set_prixKM($PrixKM) {
    $this->PrixKM = $PrixKM;
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
