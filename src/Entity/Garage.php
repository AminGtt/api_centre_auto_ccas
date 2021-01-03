<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GarageRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=GarageRepository::class)
 */
class Garage
{
    /**
     * @Groups({"annonces:list", "profil:user"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"annonces:list", "profil:user"})
     * @ORM\Column(type="string", length=255)
     */
    private $nomGarage;

    /**
     * @Groups("annonces:list")
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @Groups({"annonces:list", "profil:user"})
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @Groups({"annonces:list", "profil:user"})
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @Groups({"annonces:list", "profil:user"})
     * @ORM\Column(type="string", length=255)
     */
    private $codePostal;

    /**
     * @Groups({"annonces:list", "profil:user"})
     * @ORM\Column(type="string", length=255)
     */
    private $commune;

    /**
     * @Groups("annonces:list")
     * @ORM\Column(type="string", length=255)
     */
    private $departement;

    /**
     * @Groups({"annonces:list", "profil:user"})
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="garage", orphanRemoval=true)
     */
    private $annonces;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="garages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomGarage(): ?string
    {
        return $this->nomGarage;
    }

    public function setNomGarage(string $nomGarage): self
    {
        $this->nomGarage = $nomGarage;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    /**
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setGarage($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getGarage() === $this) {
                $annonce->setGarage(null);
            }
        }

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
}
