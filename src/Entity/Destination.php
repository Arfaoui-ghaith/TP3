<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DestinationRepository")
 */
class Destination
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
    private $des_dest;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ville", mappedBy="code_dest")
     */
    private $destinations;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_dest;

    public function __construct()
    {
        $this->destinations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesDest(): ?string
    {
        return $this->des_dest;
    }

    public function setDesDest(string $des_dest): self
    {
        $this->des_dest = $des_dest;

        return $this;
    }

    /**
     * @return Collection|Ville[]
     */
    public function getDestinations(): Collection
    {
        return $this->destinations;
    }

    public function addDestination(Ville $destination): self
    {
        if (!$this->destinations->contains($destination)) {
            $this->destinations[] = $destination;
            $destination->setCodeDest($this);
        }

        return $this;
    }

    public function removeDestination(Ville $destination): self
    {
        if ($this->destinations->contains($destination)) {
            $this->destinations->removeElement($destination);
            // set the owning side to null (unless already changed)
            if ($destination->getCodeDest() === $this) {
                $destination->setCodeDest(null);
            }
        }

        return $this;
    }

    public function getCodeDest(): ?string
    {
        return $this->code_dest;
    }

    public function setCodeDest(string $code_dest): self
    {
        $this->code_dest = $code_dest;

        return $this;
    }

    public function __toString(){
        return $this->code_dest;
    }
}
