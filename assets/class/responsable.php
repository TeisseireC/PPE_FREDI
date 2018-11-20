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
    function get_IdRespLegal() {
        return $this->IDResp;
    }

    function get_NomRespLegal() {
        return $this->NomResp;
    }

    function get_PrenomRespLegal() {
        return $this->PrenomResp;
    }

    function get_AdresseMail() {
        return $this->MailResp;
    }

    // Setters
    function set_IdRespLegal($IDResp) {
        $this->IDResp = $IDResp;
    }

    function set_NomRespLegal($NomResp) {
        $this->NomResp = $NomResp;
    }

    function set_PrenomRespLegal($PrenomResp) {
        $this->PrenomResp = $PrenomResp;
    }

    function set_AdresseMail($MailResp) {
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