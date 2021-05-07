<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entana", mappedBy="category")
     */
    private $categ_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuantiteVendu", mappedBy="category")
     */
    private $quantiteVendus;

    public function __construct()
    {
        $this->categ_id = new ArrayCollection();
        $this->quantiteVendus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Entana[]
     */
    public function getCategId(): Collection
    {
        return $this->categ_id;
    }

    public function addCategId(Entana $categId): self
    {
        if (!$this->categ_id->contains($categId)) {
            $this->categ_id[] = $categId;
            $categId->setCategory($this);
        }

        return $this;
    }

    public function removeCategId(Entana $categId): self
    {
        if ($this->categ_id->contains($categId)) {
            $this->categ_id->removeElement($categId);
            // set the owning side to null (unless already changed)
            if ($categId->getCategory() === $this) {
                $categId->setCategory(null);
            }
        }

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * @return Collection|QuantiteVendu[]
     */
    public function getQuantiteVendus(): Collection
    {
        return $this->quantiteVendus;
    }

    public function addQuantiteVendus(QuantiteVendu $quantiteVendus): self
    {
        if (!$this->quantiteVendus->contains($quantiteVendus)) {
            $this->quantiteVendus[] = $quantiteVendus;
            $quantiteVendus->setCategory($this);
        }

        return $this;
    }

    public function removeQuantiteVendus(QuantiteVendu $quantiteVendus): self
    {
        if ($this->quantiteVendus->contains($quantiteVendus)) {
            $this->quantiteVendus->removeElement($quantiteVendus);
            // set the owning side to null (unless already changed)
            if ($quantiteVendus->getCategory() === $this) {
                $quantiteVendus->setCategory(null);
            }
        }

        return $this;
    }
}
