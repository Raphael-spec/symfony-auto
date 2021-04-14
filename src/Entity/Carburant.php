<?php

namespace App\Entity;

use App\Repository\CarburantRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarburantRepository::class)
 */
class Carburant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomCarb;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCarb(): ?string
    {
        return $this->nomCarb;
    }

    public function setNomCarb(string $nomCarb): self
    {
        $this->nomCarb = $nomCarb;

        return $this;
    }
}
