<?php

 class adherent{

    // Variables
    private $numLicence = 0;
    private $sexeAdh = "?";
    private $nomAdh = "?";
    private $prenomAdh = "?";
    private $dateNaissance = "?";
    private $mailAdh = "?";
    private $telAhd = "?";
    private $adresse = "?";
    private $codePostal = "?";
    private $ville = "?";
    private $idClub = 0;
    private $idRespLegal = 0;
    
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

    function get_sexeAdh() {
        return $this->sexeAdh;
    }

    function get_nomAdh() {
        return $this->NomAdh;
    }

    function get_prenomAdh() {
        return $this->PrenomAdh;
    }

    function get_dateNaissance() {
        return $this->dateNaissance;
    }

    function get_adresseMail() {
        return $this->MailAdh;
    }

    function get_telAdh() {
        return $this->telAdh;
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

    function get_idClub() {
        return $this->idClub;
    }

    function get_idRespLegal() {
        return $this->idRespLegal;
    }

    // Setters
    function set_numLicence($NumLicence) {
        $this->NumLicence = $NumLicence;
    }

    function set_sexeAdh($sexeAdh) {
        $this->sexeAdh = $sexeAdh;
    }

    function set_nomAdh($NomAdh) {
        $this->NomAdh = $NomAdh;
    }

    function set_prenomAdh($PrenomAdh) {
        $this->PrenomAdh = $PrenomAdh;
    }

    function set_dateNaissance($dateNaissance) {
        $this->dateNaissance = $dateNaissance;
    }

    function set_adresseMail($MailAdh) {
        $this->MailAdh = $MailAdh;
    }

    function set_telAdh($telAhd) {
        $this->telAdh = $telAhd;
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

    function set_idClub($idClub) {
        $this->idClub = $idClub;
    }

    function set_idRespLegal($idRespLegal) {
        $this->idRespLegal = $idRespLegal;
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