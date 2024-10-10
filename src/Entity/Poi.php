<?php

namespace App\Entity;

use App\Repository\PoiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoiRepository::class)]
class Poi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'bigint')]
    private ?int $id = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lat = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lon = null;

    #[ORM\OneToOne(inversedBy: 'poi', cascade: ['persist', 'remove'])]
    private ?RestaurantDetails $restaurantDetails = null;


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

    public function getRestaurantDetails(): ?RestaurantDetails
    {
        return $this->restaurantDetails;
    }

    public function setRestaurantDetails(?RestaurantDetails $restaurantDetails): static
    {
        $this->restaurantDetails = $restaurantDetails;

        return $this;
    }
}
