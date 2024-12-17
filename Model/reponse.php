<?php

class reponse {
    private ?int $idrec = null; // Clé étrangère associée à la réclamation
    private ?string $reponserec = null;
    private ?string $nomrec = null;
    private ?string $adressmail = null;

    // Constructeur mis à jour pour inclure la clé étrangère
    public function __construct(?int $idrec = null, ?string $reponserec = null, ?string $nomrec = null, ?string $adressmail = null) {
        $this->idrec = $idrec;
        $this->reponserec = $reponserec;
        $this->nomrec = $nomrec;
        $this->adressmail = $adressmail;
    }
    
    // Getters
    public function getIdrec(): ?int {
        return $this->idrec;
    }

    public function getReponse(): ?string {
        return $this->reponserec;
    }

    public function getNom(): ?string {
        return $this->nomrec;
    }

    public function getMail(): ?string {
        return $this->adressmail;
    }

    // Setters
    public function setIdrec(?int $idrec): void {
        $this->idrec = $idrec;
    }

    public function setReponse(?string $reponserec): void {
        $this->reponserec = $reponserec;
    }

    public function setNom(?string $nomrec): void {
        $this->nomrec = $nomrec;
    }

    public function setMail(?string $adressmail): void {
        $this->adressmail = $adressmail;
    }
}

?>
