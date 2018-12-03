<?php

 class bordereau{

    private $IDBordereau;
    private $annee = "?";
    private $numLicence;
    private $IDTresorier = "?";
    
    // function construct
    function __construct(array $tableau = null) {
      if ($tableau != null) {
        $this->hydrater($tableau);
      }
    } // function construct

    // Getter et setter   
    function get_idBordereau() {
        return $this->IDbordereau;
    }

    function get_annee() {
        return $this->annee;
    }

    function get_numLicence() {
        return $this->numLicence;
    }

    function get_idTresorier() {
        return $this->IDTresorier;
    }

    function set_idBordereau($IDbordereau) {
        $this->IDbordereau = $IDbordereau;
    }

    function set_annee($annee) {
        $this->annee = $annee;
    }

    function set_numLicence($numLicence) {
        $this->numLicence = $numLicence;
    }

    function set_idTresorier($IDTresorier) {
        $this->IDTresorier = $IDTresorier;
    }
    // Getter et setter   
   
    // function hydrater
    function hydrater(array $tableau) {
        foreach ($tableau as $cle => $valeur) {
            $methode = 'set_' . $cle;
            if (method_exists($this, $methode)) {
                $this->$methode($valeur);
            }
        }
    } // function hydrater
} // class bordereau
?>