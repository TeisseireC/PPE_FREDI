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
  
  function get_IdMotifs() {
    return $this->IdMotifs;
  }

  function get_LibelleMotifs() {
    return $this->LibelleMotifs;
  }

  function set_IdMotifs($IdMotifs) {
    $this->IdMotifs = $IdMotifs;
  }

  function set_LibelleMotifs($LibelleMotifs) {
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

  function afficher() {
    $html = '<ul>';
    $html .= '<li>IdMotifs=' . $this->get_IdMotifs() . '</li>';
    $html .= '<li>city=' . $this->get_LibelleMotifs() . '</li>';
    $html .= '</ul>';
    return $html;
  }

}

// Classe P_km
