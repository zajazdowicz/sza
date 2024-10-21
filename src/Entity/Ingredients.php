<?php

namespace App\Entity;

use App\Repository\IngredientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientsRepository::class)]
class Ingredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isAddon = false;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\ManyToMany(targetEntity: Product::class, mappedBy: 'ingredients')]
    private Collection $products;

    /**
     * @var Collection<int, PricesIngredient>
     */
    #[ORM\ManyToMany(targetEntity: PricesIngredient::class, inversedBy: 'ingredients', cascade: ['persist', 'remove'])]
    private Collection $prices;

    #[ORM\ManyToOne(inversedBy: 'ingredients')]
    private ?RestaurantCategory $restaurantCategory = null;

    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->prices = new ArrayCollection();
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

    public function isAddon(): ?bool
    {
        return $this->isAddon;
    }

    public function setIsAddon(bool $isAddon): static
    {
        $this->isAddon = $isAddon;

        return $this;
    }
        public function getIsAddon(): bool
    {
        return $this->isAddon;
    }

    /**
     * @return Collection<int, Product>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->addIngredient($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): static
    {
        if ($this->products->removeElement($product)) {
            $product->removeIngredient($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, PricesIngredient>
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(PricesIngredient $price): static
    {
        if (!$this->prices->contains($price)) {
            $this->prices->add($price);
        }

        return $this;
    }

    public function removePrice(PricesIngredient $price): static
    {
        $this->prices->removeElement($price);

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
