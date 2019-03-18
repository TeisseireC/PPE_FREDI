<?php

 class responsable2{

    // Variables
    private $adresse = "?";
    private $codePostal = "?";
    private $ville = "?";
    private $idClub = 0;

    // function construct
    function __construct(array $tableau = null) {
      if ($tableau != null) {
        $this->hydrater($tableau);
      }
    } // function construct

    // Getters  
    function get_idRespLegal() {
        return $this->IDResp;
    }

    function get_adresse() {
        return $this->adresse;
    }

    function get_codePostal() {
        return $this->codePostal;
    }

    function get_ville() {
        return $this->ville;
    }

    function get_idClub(){
        return $this->idClub;
    }

    // Setters
    function set_idRespLegal($IDResp) {
        $this->IDResp = $IDResp;
    }

    function set_adresse($adresse) {
        $this->adresse = $adresse;
    }

    function set_codePostal($codePostal) {
        $this->codePostal = $codePostal;
    }

    function set_ville($ville) {
        $this->ville = $ville;
    }

    function set_idClub($idClub){
        $this->idClub = $idClub;
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
} // class responsable
?>