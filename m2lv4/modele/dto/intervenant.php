<?php
class Intervenant {
    private $idIntervenant;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $adresse;
    private $statut;
    private $dateEmbauche;
    private $actif;
    private $rattachementType;
    private $rattachementNom;

    public function __construct($unIdIntervenant = null, $unNom = null, $unPrenom = null, 
                               $unEmail = null, $unTelephone = null, $uneAdresse = null,
                               $unStatut = null, $uneDateEmbauche = null, $unActif = true,
                               $unRattachementType = null, $unRattachementNom = null) {
        $this->idIntervenant = $unIdIntervenant;
        $this->nom = $unNom;
        $this->prenom = $unPrenom;
        $this->email = $unEmail;
        $this->telephone = $unTelephone;
        $this->adresse = $uneAdresse;
        $this->statut = $unStatut;
        $this->dateEmbauche = $uneDateEmbauche;
        $this->actif = $unActif;
        $this->rattachementType = $unRattachementType;
        $this->rattachementNom = $unRattachementNom;
    }

    public function getIdIntervenant() { return $this->idIntervenant; }
    public function setIdIntervenant($id) { $this->idIntervenant = $id; }

    public function getNom() { return $this->nom; }
    public function setNom($nom) { $this->nom = $nom; }

    public function getPrenom() { return $this->prenom; }
    public function setPrenom($prenom) { $this->prenom = $prenom; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getTelephone() { return $this->telephone; }
    public function setTelephone($tel) { $this->telephone = $tel; }

    public function getAdresse() { return $this->adresse; }
    public function setAdresse($adresse) { $this->adresse = $adresse; }

    public function getStatut() { return $this->statut; }
    public function setStatut($statut) { $this->statut = $statut; }

    public function getDateEmbauche() { return $this->dateEmbauche; }
    public function setDateEmbauche($date) { $this->dateEmbauche = $date; }

    public function getActif() { return $this->actif; }
    public function setActif($actif) { $this->actif = $actif; }

    public function getRattachementType() { return $this->rattachementType; }
    public function setRattachementType($type) { $this->rattachementType = $type; }

    public function getRattachementNom() { return $this->rattachementNom; }
    public function setRattachementNom($nom) { $this->rattachementNom = $nom; }
}
