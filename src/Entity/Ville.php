<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $des_ville;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EtapeCircuit", mappedBy="code_ville")
     */
    private $villes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destination", inversedBy="destinations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_dest;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_ville;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesVille(): ?string
    {
        return $this->des_ville;
    }

    public function setDesVille(string $des_ville): self
    {
        $this->des_ville = $des_ville;

        return $this;
    }

    /**
     * @return Collection|EtapeCircuit[]
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(EtapeCircuit $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->setCodeVille($this);
        }

        return $this;
    }

    public function removeVille(EtapeCircuit $ville): self
    {
        if ($this->villes->contains($ville)) {
            $this->villes->removeElement($ville);
            // set the owning side to null (unless already changed)
            if ($ville->getCodeVille() === $this) {
                $ville->setCodeVille(null);
            }
        }

        return $this;
    }

    public function getCodeDest(): ?Destination
    {
        return $this->code_dest;
    }

    public function setCodeDest(?Destination $code_dest): self
    {
        $this->code_dest = $code_dest;

        return $this;
    }

    public function getCodeVille(): ?string
    {
        return $this->code_ville;
    }

    public function setCodeVille(string $code_ville): self
    {
        $this->code_ville = $code_ville;

        return $this;
    }

    public function __toString()
    {

        return $this->code_ville;

    }

}
