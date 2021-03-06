<?php

 class responsable{

    // Variables
    private $IDResp = 0;
    private $NomResp = "?";
    private $PrenomResp = "?";
    private $MailResp = "?";
    
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

    function get_nomRespLegal() {
        return $this->NomResp;
    }

    function get_prenomRespLegal() {
        return $this->PrenomResp;
    }

    function get_adresseMail() {
        return $this->MailResp;
    }

    // Setters
    function set_idRespLegal($IDResp) {
        $this->IDResp = $IDResp;
    }

    function set_nomRespLegal($NomResp) {
        $this->NomResp = $NomResp;
    }

    function set_prenomRespLegal($PrenomResp) {
        $this->PrenomResp = $PrenomResp;
    }

    function set_adresseMail($MailResp) {
        $this->MailResp = $MailResp;
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