<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, RestaurantCategory>
     */
    #[ORM\ManyToMany(targetEntity: RestaurantCategory::class, mappedBy: 'product')]
    private Collection $restaurantCategories;

    /**
     * @var Collection<int, Ingredients>
     */
    #[ORM\ManyToMany(targetEntity: Ingredients::class, inversedBy: 'products')]
    private Collection $ingredients;

    /**
     * @var Collection<int, PricesProduct>
     */
    #[ORM\ManyToMany(targetEntity: PricesProduct::class, inversedBy: 'products')]
    private Collection $pricesProduct;

    public function __construct()
    {
        $this->restaurantCategories = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
        $this->pricesProduct = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, RestaurantCategory>
     */
    public function getRestaurantCategories(): Collection
    {
        return $this->restaurantCategories;
    }

    public function addRestaurantCategory(RestaurantCategory $restaurantCategory): static
    {
        if (!$this->restaurantCategories->contains($restaurantCategory)) {
            $this->restaurantCategories->add($restaurantCategory);
            $restaurantCategory->addProduct($this);
        }

        return $this;
    }

    public function removeRestaurantCategory(RestaurantCategory $restaurantCategory): static
    {
        if ($this->restaurantCategories->removeElement($restaurantCategory)) {
            $restaurantCategory->removeProduct($this);
        }

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
        }

        return $this;
    }

    public function removeIngredient(Ingredients $ingredient): static
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }

    /**
     * @return Collection<int, PricesProduct>
     */
    public function getPricesProduct(): Collection
    {
        return $this->pricesProduct;
    }

    public function addPricesProduct(PricesProduct $pricesProduct): static
    {
        if (!$this->pricesProduct->contains($pricesProduct)) {
            $this->pricesProduct->add($pricesProduct);
        }

        return $this;
    }

    public function removePricesProduct(PricesProduct $pricesProduct): static
    {
        $this->pricesProduct->removeElement($pricesProduct);

        return $this;
    }
}
