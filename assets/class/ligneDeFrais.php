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
    function get_idFrais() {
        return $this->IDFrais;
    }

    function get_dateFrais() {
        return $this->dateFrais;
    }

    function get_trajet() {
        return $this->trajet;
    }

    function get_km() {
        return $this->km;
    }

    function get_coutTrajet() {
        return $this->coutTrajet;
    }

    function get_coutPeage() {
        return $this->coutPeage;
    }

    function get_coutRepas() {
        return $this->coutRepas;
    }

    function get_coutHebergement() {
        return $this->coutTrajet;
    }

    function get_coutTotal() {
        return $this->coutTotal;
    }

    function get_idBordereau() {
        return $this->IDbordereau;
    }

    function get_idMotifs() {
        return $this->IDMotifs;
    }

    function set_idFrais($IDFrais) {
        $this->IDFrais = $IDFrais;
    }

    function set_dateFrais($dateFrais) {
        $this->dateFrais = $dateFrais;
    }

    function settrajet($trajet) {
        $this->trajet = $trajet;
    }

    function set_km($km) {
        $this->km = $km;
    }

    function set_coutTrajet($coutTrajet) {
        $this->coutTrajet = $coutTrajet;
    }

    function set_coutPeage($coutPeage) {
        $this->coutPeage = $coutPeage;
    }

    function set_coutRepas($coutRepas) {
        $this->coutRepas = $coutRepas;
    }

    function set_coutHebergement($coutHebergement) {
        $this->coutHebergement = $coutHebergement;
    }

    function set_coutTotal($coutTotal) {
        $this->coutTotal = $coutTotal;
    }
    
    function set_idBordereau($IDbordereau) {
        $this->IDbordereau = $IDbordereau;
    }

    function set_idMotifs($IDMotifs) {
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