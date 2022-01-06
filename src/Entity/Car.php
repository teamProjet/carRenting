<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 9)]
    private $immatriculation;

    #[ORM\Column(type: 'string', length: 255)]
    private $modele;

    #[ORM\Column(type: 'string', length: 255)]
    private $couleur;

    #[ORM\Column(type: 'date')]
    private $annee;

    #[ORM\Column(type: 'string', length: 10)]
    private $kilometrage;

    #[ORM\Column(type: 'string', length: 255)]
    private $essence;

    #[ORM\Column(type: 'string', length: 255)]
    private $etatVehicule;

    #[ORM\Column(type: 'string', length: 500)]
    private $commentaire;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'car')]
    private $user;

    #[ORM\OneToOne(inversedBy: 'car', targetEntity: Contract::class, cascade: ['persist', 'remove'])]
    private $contract;

    #[ORM\OneToMany(mappedBy: 'car', targetEntity: Avis::class)]
    private $avis;

    #[ORM\Column(type: 'string', length: 500)]
    private $img;

    #[ORM\Column(type: 'float')]
    private $prixParJour;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

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

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): self
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

    public function getEssence(): ?string
    {
        return $this->essence;
    }

    public function setEssence(string $essence): self
    {
        $this->essence = $essence;

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

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): self
    {
        $this->commentaire = $commentaire;

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

    public function getContract(): ?contract
    {
        return $this->contract;
    }

    public function setContract(?contract $contract): self
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * @return Collection|Avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(Avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setCar($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getCar() === $this) {
                $avi->setCar(null);
            }
        }

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getPrixParJour(): ?float
    {
        return $this->prixParJour;
    }

    public function setPrixParJour(float $prixParJour): self
    {
        $this->prixParJour = $prixParJour;

        return $this;
    }
}
