<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtapeCircuitRepository")
 */
class EtapeCircuit
{
  

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $duree_etape;

    /**
     * @ORM\Column(type="integer")
     */
    private $ordre_etape;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Circuit", inversedBy="circuits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_circuit;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="villes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $code_ville;


    public function getDureeEtape(): ?string
    {
        return $this->duree_etape;
    }

    public function setDureeEtape(string $duree_etape): self
    {
        $this->duree_etape = $duree_etape;

        return $this;
    }

    public function getOrdreEtape(): ?int
    {
        return $this->ordre_etape;
    }

    public function setOrdreEtape(int $ordre_etape): self
    {
        $this->ordre_etape = $ordre_etape;

        return $this;
    }

    public function getCodeCircuit(): ?Circuit
    {
        return $this->code_circuit;
    }

    public function setCodeCircuit(?Circuit $code_circuit): self
    {
        $this->code_circuit = $code_circuit;

        return $this;
    }

    public function getCodeVille(): ?Ville
    {
        return $this->code_ville;
    }

    public function setCodeVille(?Ville $code_ville): self
    {
        $this->code_ville = $code_ville;

        return $this;
    }

    public function __toString(){
        return $this->code_circuit;
    }
}
