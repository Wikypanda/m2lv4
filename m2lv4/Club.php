<?php
   class Club {
    use Hydrate;
    private ?int $idClub;
    private ?string $nomClub;
    private ?string $adresseClub;
    private ?int $idCommune;
    private ?int $idLigue;
    
    public function __construct($idClub, $nomClub, $adresseClub, $idCommune, $idLigue) {
        $this->idClub = $idClub;
        $this->nomClub = $nomClub;
        $this->adresseClub = $adresseClub;
        $this->idCommune = $idCommune;
        $this->idLigue = $idLigue;
    }

    // Getters
    public function getIdClub(): ?int {
        return $this->idClub;
    }

    public function getNomClub(): ?string {
        return $this->nomClub;
    }

    public function getAdresseClub(): ?string {
        return $this->adresseClub;
    }

    public function getIdCommune(): ?int {
        return $this->idCommune;
    }

    public function getIdLigue(): ?int {
        return $this->idLigue;
    }

    // Setters
    public function setNomClub(string $nomClub): void {
        $this->nomClub = $nomClub;
    }

    public function setAdresseClub(string $adresseClub): void {
        $this->adresseClub = $adresseClub;
    }

    public function setIdCommune(int $idCommune): void {
        $this->idCommune = $idCommune;
    }

    public function setIdLigue(int $idLigue): void {
        $this->idLigue = $idLigue;
    }
}
