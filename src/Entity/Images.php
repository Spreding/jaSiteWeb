<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
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
    private $urlImage;

    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="Images")
     */
    private $projet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sizeProjet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrlImage(): ?string
    {
        return $this->urlImage;
    }

    public function setUrlImage(string $urlImage): self
    {
        $this->urlImage = $urlImage;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }

    public function getSizeProjet(): ?string
    {
        return $this->sizeProjet;
    }

    public function setSizeProjet(string $sizeProjet): self
    {
        $this->sizeProjet = $sizeProjet;

        return $this;
    }
}
