<?php
class Utilisateur {
    private $idUser;
    private $login;
    private $motDePasse;
    private $typeU;
    private $idClub;
    private $idLigue;
    private $idFonction;
    private $idTypeU;

    public function __construct($idUser = null, $login = null, $motDePasse = null,
                                $typeU = null, $idClub = null, $idLigue = null, $idFonction = null, $idTypeU) {
        $this->idUser = $idUser;
        $this->login = $login;
        $this->motDePasse = $motDePasse;
        $this->typeU = $typeU;
        $this->idClub = $idClub;
        $this->idLigue = $idLigue;
        $this->idFonction = $idFonction;
        $this->idTypeU = $idTypeU;
    }

    // Getters
    public function getIdUser() { return $this->idUser; }
    public function getLogin() { return $this->login; }
    public function getMotDePasse() { return $this->motDePasse; }
    public function getTypeU() { return $this->typeU; }
    public function getIdClub() { return $this->idClub; }
    public function getIdLigue() { return $this->idLigue; }
    public function getIdFonction() { return $this->idFonction; }
    public function getidTypeU() { return $this->idTypeU; }

    // Setters
    public function setIdUser($idUser) { $this->idUser = $idUser; }
    public function setLogin($login) { $this->login = $login; }
    public function setMotDePasse($motDePasse) { $this->motDePasse = $motDePasse; }
    public function setTypeU($typeU) { $this->typeU = $typeU; }
    public function setIdClub($idClub) { $this->idClub = $idClub; }
    public function setIdLigue($idLigue) { $this->idLigue = $idLigue; }
    public function setIdFonction($idFonction) { $this->idFonction = $idFonction; }
    public function setidTypeU($typeU) { $this->typeU = $idTypeU; }

    // Méthodes utiles
    public function estRH() { return $this->typeU === 'DRH'; }
    public function estSalarie() { return $this->typeU === 'salarié'; }
    public function estBenevole() { return strtolower($this->typeU) === 'Bénévol'; }

}
