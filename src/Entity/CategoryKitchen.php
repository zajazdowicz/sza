<?php

namespace App\Entity;

use App\Repository\CategoryKitchenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryKitchenRepository::class)]
class CategoryKitchen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    /**
     * @var Collection<int, RestaurantDetails>
     */
    #[ORM\ManyToMany(targetEntity: RestaurantDetails::class, mappedBy: 'categoryKitchen')]
    private Collection $restaurantDetails;

    public function __construct()
    {
        $this->restaurantDetails = new ArrayCollection();
    }

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

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): static
    {
        $this->logo = $logo;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection<int, RestaurantDetails>
     */
    public function getRestaurantDetails(): Collection
    {
        return $this->restaurantDetails;
    }

    public function addRestaurantDetail(RestaurantDetails $restaurantDetail): static
    {
        if (!$this->restaurantDetails->contains($restaurantDetail)) {
            $this->restaurantDetails->add($restaurantDetail);
            $restaurantDetail->addCategoryKitchen($this);
        }

        return $this;
    }

    public function removeRestaurantDetail(RestaurantDetails $restaurantDetail): static
    {
        if ($this->restaurantDetails->removeElement($restaurantDetail)) {
            $restaurantDetail->removeCategoryKitchen($this);
        }

        return $this;
    }
}
