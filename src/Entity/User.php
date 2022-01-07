<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

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
     *      minMessage = "Your password must be at least {{ limit }} characters long",
     * )
     */
    
    private $password;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 255)]
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
    private $rue;

    #[ORM\Column(type: 'string', length: 5, nullable: true)]
    private $codePostal;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $ville;

    #[ORM\Column(type: 'string', length: 15, nullable: true)]
    private $numeroPortable;

    #[ORM\Column(type: 'string', length: 12, nullable: true)]
    private $numeroPermis;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: car::class)]
    private $car;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: contract::class)]
    private $contract;

    #[ORM\OneToMany(mappedBy: 'idUser', targetEntity: avis::class)]
    private $avis;

    public function __construct()
    {
        $this->car = new ArrayCollection();
        $this->contract = new ArrayCollection();
        $this->avis = new ArrayCollection();
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

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(?string $rue): self
    {
        $this->rue = $rue;

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

    public function getNumeroPermis(): ?string
    {
        return $this->numeroPermis;
    }

    public function setNumeroPermis(?string $numeroPermis): self
    {
        $this->numeroPermis = $numeroPermis;

        return $this;
    }

    /**
     * @return Collection|car[]
     */
    public function getCar(): Collection
    {
        return $this->car;
    }

    public function addCar(car $car): self
    {
        if (!$this->car->contains($car)) {
            $this->car[] = $car;
            $car->setIdUser($this);
        }

        return $this;
    }

    public function removeCar(car $car): self
    {
        if ($this->car->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getIdUser() === $this) {
                $car->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|contract[]
     */
    public function getContract(): Collection
    {
        return $this->contract;
    }

    public function addContract(contract $contract): self
    {
        if (!$this->contract->contains($contract)) {
            $this->contract[] = $contract;
            $contract->setIdUser($this);
        }

        return $this;
    }

    public function removeContract(contract $contract): self
    {
        if ($this->contract->removeElement($contract)) {
            // set the owning side to null (unless already changed)
            if ($contract->getIdUser() === $this) {
                $contract->setIdUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|avis[]
     */
    public function getAvis(): Collection
    {
        return $this->avis;
    }

    public function addAvi(avis $avi): self
    {
        if (!$this->avis->contains($avi)) {
            $this->avis[] = $avi;
            $avi->setIdUser($this);
        }

        return $this;
    }

    public function removeAvi(avis $avi): self
    {
        if ($this->avis->removeElement($avi)) {
            // set the owning side to null (unless already changed)
            if ($avi->getIdUser() === $this) {
                $avi->setIdUser(null);
            }
        }

        return $this;
    }
}
