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

    #[ORM\Column(type: 'datetime_immutable')]
    private $debutContrat;

    #[ORM\Column(type: 'datetime_immutable')]
    private $finContrat;

    #[ORM\Column(type: 'text')]
    private $etatVehicule;

    #[ORM\Column(type: 'float')]
    private $caution;

    #[ORM\Column(type: 'float')]
    private $prixLocation;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'contract')]
    private $user;

    #[ORM\OneToOne(mappedBy: 'contract', targetEntity: Car::class, cascade: ['persist', 'remove'])]
    private $car;

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

    public function getDebutContrat(): ?\DateTimeImmutable
    {
        return $this->debutContrat;
    }

    public function setDebutContrat(\DateTimeImmutable $debutContrat): self
    {
        $this->debutContrat = $debutContrat;

        return $this;
    }

    public function getFinContrat(): ?\DateTimeImmutable
    {
        return $this->finContrat;
    }

    public function setFinContrat(\DateTimeImmutable $finContrat): self
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCar(): ?Car
    {
        return $this->car;
    }

    public function setCar(?Car $car): self
    {
        // unset the owning side of the relation if necessary
        if ($car === null && $this->car !== null) {
            $this->car->setContract(null);
        }

        // set the owning side of the relation if necessary
        if ($car !== null && $car->getContract() !== $this) {
            $car->setContract($this);
        }

        $this->car = $car;

        return $this;
    }
}
