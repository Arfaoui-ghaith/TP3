<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CircuitRepository")
 */
class Circuit
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
    private $des_circuit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duree_circuit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EtapeCircuit", mappedBy="code_circuit")
     */
    private $circuits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_circuit;

    public function __construct()
    {
        $this->circuits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesCircuit(): ?string
    {
        return $this->des_circuit;
    }

    public function setDesCircuit(string $des_circuit): self
    {
        $this->des_circuit = $des_circuit;

        return $this;
    }

    public function getDureeCircuit(): ?string
    {
        return $this->duree_circuit;
    }

    public function setDureeCircuit(string $duree_circuit): self
    {
        $this->duree_circuit = $duree_circuit;

        return $this;
    }

    /**
     * @return Collection|EtapeCircuit[]
     */
    public function getCircuits(): Collection
    {
        return $this->circuits;
    }

    public function addCircuit(EtapeCircuit $circuit): self
    {
        if (!$this->circuits->contains($circuit)) {
            $this->circuits[] = $circuit;
            $circuit->setCodeCircuit($this);
        }

        return $this;
    }

    public function removeCircuit(EtapeCircuit $circuit): self
    {
        if ($this->circuits->contains($circuit)) {
            $this->circuits->removeElement($circuit);
            // set the owning side to null (unless already changed)
            if ($circuit->getCodeCircuit() === $this) {
                $circuit->setCodeCircuit(null);
            }
        }

        return $this;
    }

    public function getCodeCircuit(): ?string
    {
        return $this->code_circuit;
    }

    public function setCodeCircuit(string $code_circuit): self
    {
        $this->code_circuit = $code_circuit;

        return $this;
    }

    public function __toString(){
        return $this->code_circuit;
    }
}
