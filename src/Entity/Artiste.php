<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"artiste:read"}},
 *     denormalizationContext={"groups"={"artiste:write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\ArtisteRepository")
 */
class Artiste
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups({"artiste:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"artiste:read", "artiste:write"})
     */
    private $Nom;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chant", mappedBy="Artiste", orphanRemoval=true)
     * @ApiSubresource
     * @Groups({"artiste:read"})
     */
    private $Chants;

    public function __construct()
    {
        $this->Chants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection|Chant[]
     */
    public function getChants(): Collection
    {
        return $this->Chants;
    }

    public function addChant(Chant $chant): self
    {
        if (!$this->Chants->contains($chant)) {
            $this->Chants[] = $chant;
            $chant->setArtiste($this);
        }

        return $this;
    }

    public function removeChant(Chant $chant): self
    {
        if ($this->Chants->contains($chant)) {
            $this->Chants->removeElement($chant);
            // set the owning side to null (unless already changed)
            if ($chant->getArtiste() === $this) {
                $chant->setArtiste(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->Nom;
    }
}
