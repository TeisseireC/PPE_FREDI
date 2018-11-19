<?php

 class adherent{

    private $IDAdh = 0;
    private $NomAdh = "?";
    private $PrenomAdh = "?";
    private $MailAdh = "?";
    
    // function construct
    function __construct(array $tableau = null) {
      if ($tableau != null) {
        $this->hydrater($tableau);
      }
    } // function construct

    // Getter et setter  
    function get_NumLicence() {
        return $this->NumLicence;
    }

    function get_NomAdh() {
        return $this->NomAdh;
    }

    function get_PreNomAdh() {
        return $this->PreNomAdh;
    }

    function get_AdresseMail() {
        return $this->MailAdh;
    }

    function set_NumLicence($NumLicence) {
        $this->NumLicence = $NumLicence;
    }

    function set_NomAdh($NomAdh) {
        $this->NomAdh = $NomAdh;
    }

    function set_PreNomAdh($PreNomAdh) {
        $this->PreNomAdh = $PreNomAdh;
    }

    function set_AdresseMail($MailAdh) {
        $this->MailAdh = $MailAdh;
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