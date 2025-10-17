<?php
class Bulletin {
    private $id;
    private $idIntervenant;
    private $mois; // format YYYY-MM
    private $netAPayer;
    private $dateEmission;
    private $fichier; // chemin vers le PDF si existant

    public function __construct($id = null, $idIntervenant = null, $mois = null, $netAPayer = null, $dateEmission = null, $fichier = null) {
        $this->id = $id;
        $this->idIntervenant = $idIntervenant;
        $this->mois = $mois;
        $this->netAPayer = $netAPayer;
        $this->dateEmission = $dateEmission;
        $this->fichier = $fichier;
    }

    public function getId() { return $this->id; }
    public function getIdIntervenant() { return $this->idIntervenant; }
    public function getMois() { return $this->mois; }
    public function getNetAPayer() { return $this->netAPayer; }
    public function getDateEmission() { return $this->dateEmission; }
    public function getFichier() { return $this->fichier; }

    public function setId($v) { $this->id = $v; }
    public function setIdIntervenant($v) { $this->idIntervenant = $v; }
    public function setMois($v) { $this->mois = $v; }
    public function setNetAPayer($v) { $this->netAPayer = $v; }
    public function setDateEmission($v) { $this->dateEmission = $v; }
    public function setFichier($v) { $this->fichier = $v; }
}
