<?php

class M_Organisation {
    private $idorganisation;
    private $nom_organisation;          // objet Role
    private $ville_organisation;    // objet Specialite
    private $adresse_organisation;
    private $cp_organisation;
    private $tel_organisation;
    private $fax_organisation;
    private $forme_juridique;
    private $activite;
    
    function __construct($idorganisation=null, $nom_organisation=null, $ville_organisation=null, $adresse_organisation=null, $cp_organisation=null, $tel_organisation=null, $fax_organisation=null, $forme_juridique=null, $activite=null) {
        $this->idorganisation = $idorganisation;
        $this->nom_organisation = $nom_organisation;
        $this->ville_organisation = $ville_organisation;
        $this->adresse_organisation = $adresse_organisation;
        $this->cp_organisation = $cp_organisation;
        $this->tel_organisation = $tel_organisation;
        $this->fax_organisation = $fax_organisation;
        $this->forme_juridique = $forme_juridique;
        $this->activite = $activite;
    }
    
    
    public function getIdorganisation() {
        return $this->idorganisation;
    }

    public function getNom_organisation() {
        return $this->nom_organisation;
    }

    public function getVille_organisation() {
        return $this->ville_organisation;
    }

    public function getAdresse_organisation() {
        return $this->adresse_organisation;
    }

    public function getCp_organisation() {
        return $this->cp_organisation;
    }

    public function getTel_organisation() {
        return $this->tel_organisation;
    }

    public function getFax_organisation() {
        return $this->fax_organisation;
    }

    public function getForme_juridique() {
        return $this->forme_juridique;
    }

    public function getActivite() {
        return $this->activite;
    }

    public function setIdorganisation($idorganisation) {
        $this->idorganisation = $idorganisation;
    }

    public function setNom_organisation($nom_organisation) {
        $this->nom_organisation = $nom_organisation;
    }

    public function setVille_organisation($ville_organisation) {
        $this->ville_organisation = $ville_organisation;
    }

    public function setAdresse_organisation($adresse_organisation) {
        $this->adresse_organisation = $adresse_organisation;
    }

    public function setCp_organisation($cp_organisation) {
        $this->cp_organisation = $cp_organisation;
    }

    public function setTel_organisation($tel_organisation) {
        $this->tel_organisation = $tel_organisation;
    }

    public function setFax_organisation($fax_organisation) {
        $this->fax_organisation = $fax_organisation;
    }

    public function setForme_juridique($forme_juridique) {
        $this->forme_juridique = $forme_juridique;
    }

    public function setActivite($activite) {
        $this->activite = $activite;
    }
    
}