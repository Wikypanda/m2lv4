<?php
class Contrat {
    private $idContrat;
    private $dateDebut;
    private $dateFin;
    private $typeContrat;
    private $nbHeures;
    private $idUser;
    private $salaireBrut;
    private $actif;

    public function __construct($idContrat = null, $dateDebut = null, $dateFin = null, 
                               $typeContrat = null, $nbHeures = null, $idUser = null, 
                               $salaireBrut = null, $actif = true) {
        $this->idContrat = $idContrat;
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
        $this->typeContrat = $typeContrat;
        $this->nbHeures = $nbHeures;
        $this->idUser = $idUser;
        $this->salaireBrut = $salaireBrut;
        $this->actif = $actif;
    }

    // Getters
    public function getIdContrat() { return $this->idContrat; }
    public function getDateDebut() { return $this->dateDebut; }
    public function getDateFin() { return $this->dateFin; }
    public function getTypeContrat() { return $this->typeContrat; }
    public function getNbHeures() { return $this->nbHeures; }
    public function getIdUser() { return $this->idUser; }
    public function getSalaireBrut() { return $this->salaireBrut; }
    public function getActif() { return $this->actif; }

    // Setters
    public function setIdContrat($id) { $this->idContrat = $id; }
    public function setDateDebut($date) { $this->dateDebut = $date; }
    public function setDateFin($date) { $this->dateFin = $date; }
    public function setTypeContrat($type) { $this->typeContrat = $type; }
    public function setNbHeures($nb) { $this->nbHeures = $nb; }
    public function setIdUser($id) { $this->idUser = $id; }
    public function setSalaireBrut($salaire) { $this->salaireBrut = $salaire; }
    public function setActif($actif) { $this->actif = $actif; }
}
?>