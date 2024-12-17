<?php

class rec {
    private ?int $idrec;
    private ?string $nomrec;
    private ?string $adressmail;
    private ?string $sujetrec;
    private ?string $descriptionrec;
    private ?string $date_creation; // Nouveau champ pour la date de création
    private ?string $statut_rec;    // Nouveau champ pour le statut de la réclamation

    // Constructeur avec les nouveaux attributs
    public function __construct(
        ?int $idrec = null,
        ?string $nomrec = null,
        ?string $adressmail = null,
        ?string $sujetrec = null,
        ?string $descriptionrec = null,
        ?string $date_creation = null,
        ?string $statut_rec = "Nouvelle"
    ) {
        $this->idrec = $idrec;
        $this->nomrec = $nomrec;
        $this->adressmail = $adressmail;
        $this->sujetrec = $sujetrec;
        $this->descriptionrec = $descriptionrec;
        $this->date_creation = $date_creation ?? date("Y-m-d H:i:s"); // Définit la date actuelle si aucune n'est fournie
        $this->statut_rec = $statut_rec;
    }
    
    // Getters
    public function getIdrec(): ?int {
        return $this->idrec;
    }

    public function getNom(): ?string {
        return $this->nomrec;
    }

    public function getMail(): ?string {
        return $this->adressmail;
    }

    public function getSujet(): ?string {
        return $this->sujetrec;
    }

    public function getDescription(): ?string {
        return $this->descriptionrec;
    }

    public function getDateCreation(): ?string {
        return $this->date_creation;
    }

    public function getStatutRec(): ?string {
        return $this->statut_rec;
    }

    // Setters (optionnels si nécessaires)
    public function setNom(?string $nomrec): void {
        $this->nomrec = $nomrec;
    }

    public function setMail(?string $adressmail): void {
        $this->adressmail = $adressmail;
    }

    public function setSujet(?string $sujetrec): void {
        $this->sujetrec = $sujetrec;
    }

    public function setDescription(?string $descriptionrec): void {
        $this->descriptionrec = $descriptionrec;
    }

    public function setDateCreation(?string $date_creation): void {
        $this->date_creation = $date_creation;
    }

    public function setStatutRec(?string $statut_rec): void {
        $this->statut_rec = $statut_rec;
    }
}

?>
