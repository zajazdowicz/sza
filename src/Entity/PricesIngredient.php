<?php

namespace App\Entity;

use App\Repository\PricesIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PricesIngredientRepository::class)]
class PricesIngredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    /**
     * @var Collection<int, Ingredients>
     */
    #[ORM\ManyToMany(targetEntity: Ingredients::class, mappedBy: 'prices')]
    private Collection $ingredients;

    /**
     * @var Collection<int, SizeProduct>
     */
    #[ORM\ManyToMany(targetEntity: SizeProduct::class, inversedBy: 'pricesIngredients')]
    private Collection $sizeProduct;

    #[ORM\ManyToOne(inversedBy: 'pricesIngredient')]
    private ?RestaurantCategory $restaurantCategory = null;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->sizeProduct = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, Ingredients>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredients $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->addPrice($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredients $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            $ingredient->removePrice($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, SizeProduct>
     */
    public function getSizeProduct(): Collection
    {
        return $this->sizeProduct;
    }

    public function addSizeProduct(SizeProduct $sizeProduct): static
    {
        if (!$this->sizeProduct->contains($sizeProduct)) {
            $this->sizeProduct->add($sizeProduct);
        }

        return $this;
    }

    public function removeSizeProduct(SizeProduct $sizeProduct): static
    {
        $this->sizeProduct->removeElement($sizeProduct);

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
