<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 * @Vich\Uploadable
 */
class Produit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="products", fileNameProperty="image")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     *
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Etat::class, inversedBy="produits")
     */
    private $etat;

    /**
     * @ORM\ManyToOne(targetEntity=Prix::class, inversedBy="produits")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity=Concurrence::class, cascade={"persist", "remove"})
     */
    private $concurrence;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }


    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }


    public function setUpdatedAt(?\DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getEtat(): Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getPrice(): ?Prix
    {
        return $this->price;
    }

    public function setPrice(?Prix $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getConcurrence(): ?Concurrence
    {
        return $this->concurrence;
    }

    public function setConcurrence(?Concurrence $concurrence): self
    {
        $this->concurrence = $concurrence;

        return $this;
    }
}
