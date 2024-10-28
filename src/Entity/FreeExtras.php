<?php

namespace App\Entity;

use App\Repository\FreeExtrasRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FreeExtrasRepository::class)]
class FreeExtras
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'freeExtras')]
    #[ORM\JoinColumn(nullable: false)]
    private ?RestaurantCategory $restaurantCategory = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRestaurantCategory(): ?RestaurantCategory
    {
        return $this->restaurantCategory;
    }

    public function setRestaurantCategory(?RestaurantCategory $restaurantCategory): static
    {
        $this->restaurantCategory = $restaurantCategory;

        return $this;
    }
}
