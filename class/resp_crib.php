<?php

/**
* Classe RespCrib
*/
class RespCrib {
    
    /* Attributs */
    private $idRespCrib = 0;
    private $nomRespCrib = "???";
    private $prenomRespCrib = "???";
    private $idLigue = 0;
    
    /* Constructeur */ 
    function __construct(array $tableau = null) {
        if ($tableau != null) {
            $this->hydrater($tableau);
        }
    }
    
    /* Getter et Setter */
    function get_idRespCrib() {
        return $this->idRespCrib;
    }
    
    function get_nomRespCrib() {
        return $this->nomRespCrib;
    }
    
    function get_prenomRespCrib() {
        return $this->prenomRespCrib;
    }
    
    function get_idLigue() {
        return $this->idLigue;
    }
    
    function set_idRespCrib($idRespCrib) {
        $this->idRespCrib = $idRespCrib;
    }
    
    function set_nomRespCrib($nomRespCrib) {
        $this->nomRespCrib = $nomRespCrib;
    }
    
    function set_prenomRespCrib($prenomRespCrib) {
        $this->prenomRespCrib = $prenomRespCrib;
    }
    
    function set_idLigue($idLigue) {
        $this->idLigue = $idLigue;
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
