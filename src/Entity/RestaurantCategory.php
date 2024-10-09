<?php

namespace App\Entity;

use App\Repository\RestaurantCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantCategoryRepository::class)]
class RestaurantCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $nameCategory = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    /**
     * @var Collection<int, RestaurantDetails>
     */
    #[ORM\ManyToMany(targetEntity: RestaurantDetails::class, mappedBy: 'restaurantCategory')]
    private Collection $restaurantDetails;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'restaurantCategories')]
    private Collection $product;

    public function __construct()
    {
        $this->restaurantDetails = new ArrayCollection();
        $this->product = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): static
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

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
            $restaurantDetail->addRestaurantCategory($this);
        }

        return $this;
    }

    public function removeRestaurantDetail(RestaurantDetails $restaurantDetail): static
    {
        if ($this->restaurantDetails->removeElement($restaurantDetail)) {
            $restaurantDetail->removeRestaurantCategory($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProduct(): Collection
    {
        return $this->product;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->product->contains($product)) {
            $this->product->add($product);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        $this->product->removeElement($product);

        return $this;
    }
}
