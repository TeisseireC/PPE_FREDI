<?php

/**
* Classe Trésorier
*
*/
class Tresorier {
    
    /* Attributs */
    private $idTresorier = 0;
    private $nomTresorier = "???";
    private $prenomTresorier = "???";
    private $idClub = 0;
    
    /* Constructeur */ 
    function __construct(array $tableau = null) {
        if ($tableau != null) {
            $this->hydrater($tableau);
        }
    }
    
    /* Getter et Setter */
    function get_idTresorier() {
        return $this->idTresorier;
    }
    
    function get_nomTresorier() {
        return $this->nomTresorier;
    }
    
    function get_prenomTresorier() {
        return $this->prenomTresorier;
    }
    
    function get_idClub() {
        return $this->idClub;
    }
    
    function set_idTresorier($idTresorier) {
        $this->idTresorier = $idTresorier;
    }
    
    function set_nomTresorier($nomTresorier) {
        $this->nomTresorier = $nomTresorier;
    }
    
    function set_prenomTresorier($prenomTresorier) {
        $this->prenomTresorier = $prenomTresorier;
    }
    
    function set_idClub($idClub) {
        $this->idClub = $idClub;
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
