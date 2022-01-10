<?php

namespace App\Entity;

use App\Repository\ContractRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContractRepository::class)]
class Contract
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $numeroContrat;

    #[ORM\Column(type: 'date')]
    private $debutContrat;

    #[ORM\Column(type: 'date')]
    private $finContrat;

    #[ORM\Column(type: 'text')]
    private $etatVehicule;

    #[ORM\Column(type: 'float')]
    private $caution;

    #[ORM\Column(type: 'float')]
    private $prixLocation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroContrat(): ?string
    {
        return $this->numeroContrat;
    }

    public function setNumeroContrat(string $numeroContrat): self
    {
        $this->numeroContrat = $numeroContrat;

        return $this;
    }

    public function getDebutContrat(): ?\DateTimeInterface
    {
        return $this->debutContrat;
    }

    public function setDebutContrat(\DateTimeInterface $debutContrat): self
    {
        $this->debutContrat = $debutContrat;

        return $this;
    }

    public function getFinContrat(): ?\DateTimeInterface
    {
        return $this->finContrat;
    }

    public function setFinContrat(\DateTimeInterface $finContrat): self
    {
        $this->finContrat = $finContrat;

        return $this;
    }

    public function getEtatVehicule(): ?string
    {
        return $this->etatVehicule;
    }

    public function setEtatVehicule(string $etatVehicule): self
    {
        $this->etatVehicule = $etatVehicule;

        return $this;
    }

    public function getCaution(): ?float
    {
        return $this->caution;
    }

    public function setCaution(float $caution): self
    {
        $this->caution = $caution;

        return $this;
    }

    public function getPrixLocation(): ?float
    {
        return $this->prixLocation;
    }

    public function setPrixLocation(float $prixLocation): self
    {
        $this->prixLocation = $prixLocation;

        return $this;
    }
}
