<?php
class Ligue {
    use Hydrate;

    private ?int $idLigue;
    private ?string $nomLigue;
    private ?string $site;
    private ?string $descriptif;

    public function __construct(?int $idLigue, ?string $nomLigue, ?string $site, ?string $descriptif) {
        $this->idLigue = $idLigue;
        $this->nomLigue = $nomLigue; // Correction : utiliser le bon nom de propriété
        $this->site = $site;
        $this->descriptif = $descriptif;
    }

    public function getIdLigue(): ?int {
        return $this->idLigue;
    }

    public function getNom(): ?string {
        return $this->nomLigue;
    }

    public function getSite(): ?string {
        return $this->site;
    }

    public function getDescriptif(): ?string {
        return $this->descriptif;
    }

    public function setIdLigue(?int $idLigue): void {
        $this->idLigue = $idLigue;
    }

    public function setNom(?string $nomLigue): void {
        $this->nomLigue = $nomLigue;
    }

    public function setSite(?string $site): void {
        $this->site = $site;
    }

    public function setDescriptif(?string $descriptif): void {
        $this->descriptif = $descriptif;
    }
}
