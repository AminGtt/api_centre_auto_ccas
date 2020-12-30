<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prix;

    /**
     * @ORM\Column(type="date")
     */
    private $anneeMiseEnCirculation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $kilometrage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDepotAnnonce;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descriptionGenerale;

    /**
     * @ORM\ManyToOne(targetEntity=Energie::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $energie;

    /**
     * @ORM\OneToMany(targetEntity=Photo::class, mappedBy="annonce", orphanRemoval=true)
     */
    private $photos;

    /**
     * @ORM\ManyToOne(targetEntity=Modele::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $modele;

    /**
     * @ORM\OneToMany(targetEntity=ContactMail::class, mappedBy="annonce", orphanRemoval=true)
     */
    private $contactMails;

    /**
     * @ORM\ManyToOne(targetEntity=Garage::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $garage;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->contactMails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getAnneeMiseEnCirculation(): ?\DateTimeInterface
    {
        return $this->anneeMiseEnCirculation;
    }

    public function setAnneeMiseEnCirculation(\DateTimeInterface $anneeMiseEnCirculation): self
    {
        $this->anneeMiseEnCirculation = $anneeMiseEnCirculation;

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

    public function getDateDepotAnnonce(): ?\DateTimeInterface
    {
        return $this->dateDepotAnnonce;
    }

    public function setDateDepotAnnonce(\DateTimeInterface $dateDepotAnnonce): self
    {
        $this->dateDepotAnnonce = $dateDepotAnnonce;

        return $this;
    }

    public function getDescriptionGenerale(): ?string
    {
        return $this->descriptionGenerale;
    }

    public function setDescriptionGenerale(string $descriptionGenerale): self
    {
        $this->descriptionGenerale = $descriptionGenerale;

        return $this;
    }

    public function getEnergie(): ?Energie
    {
        return $this->energie;
    }

    public function setEnergie(?Energie $energie): self
    {
        $this->energie = $energie;

        return $this;
    }

    /**
     * @return Collection|Photo[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setAnnonce($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): self
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getAnnonce() === $this) {
                $photo->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * @return Collection|ContactMail[]
     */
    public function getContactMails(): Collection
    {
        return $this->contactMails;
    }

    public function addContactMail(ContactMail $contactMail): self
    {
        if (!$this->contactMails->contains($contactMail)) {
            $this->contactMails[] = $contactMail;
            $contactMail->setAnnonce($this);
        }

        return $this;
    }

    public function removeContactMail(ContactMail $contactMail): self
    {
        if ($this->contactMails->removeElement($contactMail)) {
            // set the owning side to null (unless already changed)
            if ($contactMail->getAnnonce() === $this) {
                $contactMail->setAnnonce(null);
            }
        }

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): self
    {
        $this->garage = $garage;

        return $this;
    }
}
