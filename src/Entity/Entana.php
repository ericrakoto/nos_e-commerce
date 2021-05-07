<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntanaRepository")
 */
class Entana
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
    private $titre_produit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sary;

    /**
     * @ORM\Column(type="integer")
     */
    private $vidiny;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Panier", inversedBy="panier")
     */
    private $panier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="categ_id")
     */
    private $category;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $QuantiteVendu;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuantiteVendu", mappedBy="quantite")
     */
    private $quantiteVendus;

    public function __construct()
    {
        $this->quantiteVendus = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreProduit(): ?string
    {
        return $this->titre_produit;
    }

    public function setTitreProduit(string $titre_produit): self
    {
        $this->titre_produit = $titre_produit;

        return $this;
    }

    public function getSary(): ?string
    {
        return $this->sary;
    }

    public function setSary(string $sary): self
    {
        $this->sary = $sary;

        return $this;
    }

    public function getVidiny(): ?int
    {
        return $this->vidiny;
    }

    public function setVidiny(int $vidiny): self
    {
        $this->vidiny = $vidiny;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getQuantiteVendu(): ?int
    {
        return $this->QuantiteVendu;
    }

    public function setQuantiteVendu(?int $QuantiteVendu): self
    {
        $this->QuantiteVendu = $QuantiteVendu;

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
            $quantiteVendus->setQuantite($this);
        }

        return $this;
    }

    public function removeQuantiteVendus(QuantiteVendu $quantiteVendus): self
    {
        if ($this->quantiteVendus->contains($quantiteVendus)) {
            $this->quantiteVendus->removeElement($quantiteVendus);
            // set the owning side to null (unless already changed)
            if ($quantiteVendus->getQuantite() === $this) {
                $quantiteVendus->setQuantite(null);
            }
        }

        return $this;
    }


}
