<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
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
     * @ORM\Column(type="string", length=255)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $logiciels;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Image_Preview;


    /**
     * @ORM\Column(type="integer")
     */
    private $sizeGrid;

    /**
     * @ORM\ManyToOne(targetEntity=Types::class, inversedBy="projets")
     */
    private $types;

    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="projet")
     */
    private $Images;


    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->Images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLogiciels(): ?string
    {
        return $this->logiciels;
    }

    public function setLogiciels(string $logiciels): self
    {
        $this->logiciels = $logiciels;

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

    public function getImage_Preview(): ?string
    {
        return $this->Image_Preview;
    }

    public function setImage_Preview(string $Image_Preview): self
    {
        $this->Image_Preview = $Image_Preview;

        return $this;
    }

    public function getSizeGrid(): ?int
    {
        return $this->sizeGrid;
    }

    public function setSizeGrid(int $sizeGrid): self
    {
        $this->sizeGrid = $sizeGrid;

        return $this;
    }
    /**
     * @return Collection|Types[]
     */
    public function getTypes(): ?Types
    {
        return $this->types;
    }

    public function setTypes(?Types $types): self
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->Images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->Images->contains($image)) {
            $this->Images[] = $image;
            $image->setProjet($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->Images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProjet() === $this) {
                $image->setProjet(null);
            }
        }

        return $this;
    }

    public function ToJson(): array
    {
        return $response = [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'type' => $this->getTypes(),
            'date' => $this->getDate(),
            'logiciels' => $this->getLogiciels(),
            'description' => $this->getDescription(),
            'images' => []
        ];
    }
}
