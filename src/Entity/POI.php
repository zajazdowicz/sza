<?php

namespace App\Entity;

use App\Repository\POIRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: POIRepository::class)]
class Poi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lon = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $id_openstreetmap = null;


    public function getId(): ?int
    {
        return $this->id;
    }
    public function getLat(): ?string
    {
        return $this->lat;
    }

    public function setLat(?string $lat): static
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLon(): ?string
    {
        return $this->lon;
    }

    public function setLon(?string $lon): static
    {
        $this->lon = $lon;

        return $this;
    }

    public function getIdOpenstreetmap(): ?string
    {
        return $this->id_openstreetmap;
    }

    public function setIdOpenstreetmap(string $id_openstreetmap): static
    {
        $this->id_openstreetmap = $id_openstreetmap;
        return $this;
    }
}
