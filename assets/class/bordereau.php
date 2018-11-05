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
    function getIDBordereau() {
        return $this->IDbordereau;
    }

    function getAnnee() {
        return $this->annee;
    }

    function getNumLicence() {
        return $this->numLicence;
    }

    function getIDTresorier() {
        return $this->IDTresorier;
    }

    function setIDBordereau($IDbordereau) {
        $this->IDbordereau = $IDbordereau;
    }

    function setAnnee($annee) {
        $this->annee = $annee;
    }

    function setNumLicence($numLicence) {
        $this->numLicence = $numLicence;
    }

    function setIDTresorier($IDTresorier) {
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