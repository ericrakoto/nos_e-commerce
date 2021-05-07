<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuantiteVenduRepository")
 */
class QuantiteVendu
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entana", inversedBy="quantiteVendus")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="quantiteVendus")
     */
    private $category;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?Entana
    {
        return $this->quantite;
    }

    public function setQuantite(?Entana $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(?\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
    }
}
