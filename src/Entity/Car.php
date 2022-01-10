<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $modele;

    #[ORM\Column(type: 'text')]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $couleur;

    #[ORM\Column(type: 'string', length: 255)]
    private $immatriculation;

    #[ORM\Column(type: 'string', length: 255)]
    private $annee;

    #[ORM\Column(type: 'string', length: 255)]
    private $kilometrage;

    #[ORM\Column(type: 'string', length: 255)]
    private $marque;

    #[ORM\Column(type: 'float')]
    private $tarifJournee;

    #[ORM\Column(type: 'string', length: 255)]
    private $essence;

    #[ORM\Column(type: 'integer')]
    private $disponibilité;

    #[ORM\Column(type: 'text')]
    private $commentaire;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;

        return $this;
    }

    public function getAnnee(): ?string
    {
        return $this->annee;
    }

    public function setAnnee(string $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getKilometrage(): ?string
    {
        return $this->kilometrage;
    }

    public function setKilometrage(string $kilometrage): self
    {
        $this->kilometrage = $kilometrage;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getTarifJournee(): ?float
    {
        return $this->tarifJournee;
    }

    public function setTarifJournee(float $tarifJournee): self
    {
        $this->tarifJournee = $tarifJournee;

        return $this;
    }

    public function getEssence(): ?string
    {
        return $this->essence;
    }

    public function setEssence(string $essence): self
    {
        $this->essence = $essence;

        return $this;
    }

    public function getDisponibilité(): ?int
    {
        return $this->disponibilité;
    }

    public function setDisponibilité(int $disponibilité): self
    {
        $this->disponibilité = $disponibilité;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }
}
