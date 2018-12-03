<?php

 class adherent{

    // Variables
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

    // Getters
    function get_numLicence() {
        return $this->NumLicence;
    }

    function get_nomAdh() {
        return $this->NomAdh;
    }

    function get_preNomAdh() {
        return $this->PreNomAdh;
    }

    function get_adresseMail() {
        return $this->MailAdh;
    }

    // Setters
    function set_numLicence($NumLicence) {
        $this->NumLicence = $NumLicence;
    }

    function set_nomAdh($NomAdh) {
        $this->NomAdh = $NomAdh;
    }

    function set_preNomAdh($PreNomAdh) {
        $this->PreNomAdh = $PreNomAdh;
    }

    function set_adresseMail($MailAdh) {
        $this->MailAdh = $MailAdh;
    }   
   
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