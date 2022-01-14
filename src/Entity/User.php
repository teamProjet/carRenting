<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
     /**
     * @Assert\NotBlank
     */
    private $email;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
     /**
     * @Assert\Length(
     *      min = 8,
     *      minMessage = "Votre mot de passe doit contenir au moins {{ limit }} caractères",
     * )
     */
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
      /**
     * @Assert\Length(
     *      min = 5,
     *      max = 10,
     *      minMessage = "Your login must be at least {{ limit }} characters long",
     *      maxMessage = "Your login cannot be longer than {{ limit }} characters"
     * )
     */
    private $login;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $numeroRue;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nomdeRue;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $codePostal;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ville;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private $numeroPortable;

    #[ORM\Column(type: 'string', length: 12, nullable: true)]
    private $numeroPermisConduire;

    #[ORM\Column(type: 'datetime_immutable', nullable: true)]
    private $annee;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Avis::class)]
    private $avis;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Car::class)]
    private $car;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Contract::class)]
    private $contract;

    public function __construct()
    {
        $this->avis = new ArrayCollection();
        $this->car = new ArrayCollection();
        $this->contract = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(?string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getNumeroRue(): ?string
    {
        return $this->numeroRue;
    }

    public function setNumeroRue(?string $numeroRue): self
    {
        $this->numeroRue = $numeroRue;
        return $this;
    }

    public function getNomdeRue(): ?string
    {
        return $this->nomdeRue;
    }

    public function setNomdeRue(?string $nomdeRue): self
    {
        $this->nomdeRue = $nomdeRue;
        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(?string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNumeroPortable(): ?string
    {
        return $this->numeroPortable;
    }

    public function setNumeroPortable(?string $numeroPortable): self
    {
        $this->numeroPortable = $numeroPortable;

        return $this;
    }

    public function getNumeroPermisConduire(): ?string
    {
        return $this->numeroPermisConduire;
    }

    public function setNumeroPermisConduire(?string $numeroPermisConduire): self
    {
        $this->numeroPermisConduire = $numeroPermisConduire;

        return $this;
    }

    public function getAnnee(): ?\DateTimeImmutable
    {
        return $this->annee;
    }

    public function setAnnee(?\DateTimeImmutable $annee): self
    {
        $this->annee = $annee;
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
            $avi->setUser($this);
        }

        return $this;
    }

    public function removeAvi(Avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getUser() === $this) {
                $avi->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Car[]
     */
    public function getCar(): Collection
    {
        return $this->car;
    }

    public function addCar(Car $car): self
    {
        if (!$this->car->contains($car)) {
            $this->car[] = $car;
            $car->setUser($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->car->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getUser() === $this) {
                $car->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Contract[]
     */
    public function getContract(): Collection
    {
        return $this->contract;
    }

    public function addContract(Contract $contract): self
    {
        if (!$this->contract->contains($contract)) {
            $this->contract[] = $contract;
            $contract->setUser($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): self
    {
        if ($this->contract->removeElement($contract)) {
            // set the owning side to null (unless already changed)
            if ($contract->getUser() === $this) {
                $contract->setUser(null);
            }
        }

        return $this;
    }
  
    public function __toString()
    {
        return $this->id;
    }
}
