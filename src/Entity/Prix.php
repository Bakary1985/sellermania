<?php

namespace App\Entity;

use App\Repository\PrixRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrixRepository::class)
 */
class Prix
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixNormal;

    /**
     * @ORM\Column(type="integer")
     */
    private $prixPlancher;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPlancher;

    /**
     * @ORM\OneToMany(targetEntity=Produit::class, mappedBy="price")
     */
    private $produits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixNormal(): ?int
    {
        return $this->prixNormal;
    }

    public function setPrixNormal(int $prixNormal): self
    {
        $this->prixNormal = $prixNormal;

        return $this;
    }

    public function getPrixPlancher(): ?int
    {
        return $this->prixPlancher;
    }

    public function setPrixPlancher(int $prixPlancher): self
    {
        $this->prixPlancher = $prixPlancher;

        return $this;
    }

    public function getIsPlancher(): ?bool
    {
        return $this->isPlancher;
    }

    public function setIsPlancher(?bool $isPlancher): self
    {
        $this->isPlancher = $isPlancher;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
            $produit->setPrice($this);
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->produits->contains($produit)) {
            $this->produits->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getPrice() === $this) {
                $produit->setPrice(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    /**
     * Generates the magic method
     *
     */
    public function __toString(){
        return $this->name;
    }
}
