<?php

 class ligneDeFrais{

    private $IDFrais;
    private $dateFrais = "?";
    private $trajet = "?";
    private $km = "?";
    private $coutTrajet = "?";
    private $coutPeage = "?";
    private $coutRepas = "?";
    private $coutHebergement = "?";
    private $coutTotal = "?";
    private $IDBordereau;
    private $IDMotifs = "?";
    
    // function construct
    function __construct(array $tableau = null) {
      if ($tableau != null) {
        $this->hydrater($tableau);
      }
    } // function construct

    // Getter et setter   
    function getIDFrais() {
        return $this->IDFrais;
    }

    function getDateFrais() {
        return $this->dateFrais;
    }

    function getTrajet() {
        return $this->trajet;
    }

    function getKm() {
        return $this->km;
    }

    function getCoutTrajet() {
        return $this->coutTrajet;
    }

    function getCoutPeage() {
        return $this->coutPeage;
    }

    function getCoutRepas() {
        return $this->coutRepas;
    }

    function getCoutHebergement() {
        return $this->coutTrajet;
    }

    function getCoutTotal() {
        return $this->coutTotal;
    }

    function getIDBordereau() {
        return $this->IDbordereau;
    }

    function getIDMotifs() {
        return $this->IDMotifs;
    }

    function setIDFrais($IDFrais) {
        $this->IDFrais = $IDFrais;
    }

    function setDateFrais($dateFrais) {
        $this->dateFrais = $dateFrais;
    }

    function setTrajet($trajet) {
        $this->trajet = $trajet;
    }

    function setKm($km) {
        $this->km = $km;
    }

    function setCoutTrajet($coutTrajet) {
        $this->coutTrajet = $coutTrajet;
    }

    function setcoutPeage($coutPeage) {
        $this->coutPeage = $coutPeage;
    }

    function setcoutRepas($coutRepas) {
        $this->coutRepas = $coutRepas;
    }

    function setcoutHebergement($coutHebergement) {
        $this->coutHebergement = $coutHebergement;
    }

    function setcoutTotal($coutTotal) {
        $this->coutTotal = $coutTotal;
    }
    
    function setIDBordereau($IDbordereau) {
        $this->IDbordereau = $IDbordereau;
    }

    function setIDMotifs($IDMotifs) {
        $this->IDMotifs = $IDMotifs;
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
} // class ligneDeFrais
?>