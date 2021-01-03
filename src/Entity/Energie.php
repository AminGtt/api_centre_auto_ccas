<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\EnergieRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EnergieRepository::class)
 */
class Energie
{
    /**
     * @Groups({"home", "annonces:list"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"home", "annonces:list"})
     * @ORM\Column(type="string", length=255)
     */
    private $nomEnergie;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="energie", orphanRemoval=true)
     */
    private $annonces;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnergie(): ?string
    {
        return $this->nomEnergie;
    }

    public function setNomEnergie(string $nomEnergie): self
    {
        $this->nomEnergie = $nomEnergie;

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
            $annonce->setEnergie($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getEnergie() === $this) {
                $annonce->setEnergie(null);
            }
        }

        return $this;
    }
}
