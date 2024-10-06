<?php

namespace App\Entity;

use App\Repository\RestaurantDetailsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantDetailsRepository::class)]
class RestaurantDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameRestaurant = null;

    #[ORM\Column(nullable: true)]
    private ?float $averageOpinion = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $minPurchaseAmount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    private ?string $minDeliveryAmount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\OneToOne(mappedBy: 'restaurantDetails', cascade: ['persist', 'remove'])]
    private ?Poi $poi = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameRestaurant(): ?string
    {
        return $this->nameRestaurant;
    }

    public function setNameRestaurant(string $nameRestaurant): static
    {
        $this->nameRestaurant = $nameRestaurant;

        return $this;
    }

    public function getAverageOpinion(): ?float
    {
        return $this->averageOpinion;
    }

    public function setAverageOpinion(?float $averageOpinion): static
    {
        $this->averageOpinion = $averageOpinion;

        return $this;
    }

    public function getMinPurchaseAmount(): ?string
    {
        return $this->minPurchaseAmount;
    }

    public function setMinPurchaseAmount(?string $minPurchaseAmount): static
    {
        $this->minPurchaseAmount = $minPurchaseAmount;

        return $this;
    }

    public function getMinDeliveryAmount(): ?string
    {
        return $this->minDeliveryAmount;
    }

    public function setMinDeliveryAmount(?string $minDeliveryAmount): static
    {
        $this->minDeliveryAmount = $minDeliveryAmount;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function getPoi(): ?Poi
    {
        return $this->poi;
    }

    public function setPoi(?Poi $poi): static
    {
        // unset the owning side of the relation if necessary
        if ($poi === null && $this->poi !== null) {
            $this->poi->setRestaurantDetails(null);
        }

        // set the owning side of the relation if necessary
        if ($poi !== null && $poi->getRestaurantDetails() !== $this) {
            $poi->setRestaurantDetails($this);
        }

        $this->poi = $poi;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
}
