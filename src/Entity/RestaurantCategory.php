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

    #[ORM\Column(type: 'boolean')]
    private ?bool $isActive = false;

    /**
     * @var Collection<int, RestaurantDetails>
     */
    #[ORM\ManyToMany(targetEntity: RestaurantDetails::class, mappedBy: 'restaurantCategory', cascade: ['persist', 'remove'])]
    private Collection $restaurantDetails;

    /**
     * @var Collection<int, Product>
     */
    #[ORM\ManyToMany(targetEntity: Product::class, inversedBy: 'restaurantCategories', cascade: ['persist'])]
    private Collection $product;

    /**
     * @var Collection<int, Ingredients>
     */
    #[ORM\OneToMany(targetEntity: Ingredients::class, mappedBy: 'restaurantCategory', cascade: ['persist'])]
    private Collection $ingredients;

    /**
     * @var Collection<int, PricesIngredient>
     */
    #[ORM\OneToMany(targetEntity: PricesIngredient::class, mappedBy: 'restaurantCategory')]
    private Collection $pricesIngredient;

    /**
     * @var Collection<int, SizeProduct>
     */
    #[ORM\OneToMany(targetEntity: SizeProduct::class, mappedBy: 'restaurantCategory', cascade: ['persist'])]
    private Collection $sizeProduct;

    /**
     * @var Collection<int, FreeExtras>
     */
    #[ORM\OneToMany(targetEntity: FreeExtras::class, mappedBy: 'restaurantCategory', orphanRemoval: true, cascade: ['persist'])]
    private Collection $freeExtras;

    #[ORM\Column(nullable: true)]
    private ?int $quantityFree = null;

    #[ORM\Column(length: 32, nullable: true)]
    private ?string $typeSize = null;



    public function __construct()
    {
        $this->restaurantDetails = new ArrayCollection();
        $this->product = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
        $this->pricesIngredient = new ArrayCollection();
        $this->sizeProduct = new ArrayCollection();
        $this->freeExtras = new ArrayCollection();
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

    public function setActive(?bool $isActive): static
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
            $ingredient->setRestaurantCategory($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredients $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRestaurantCategory() === $this) {
                $ingredient->setRestaurantCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PricesIngredient>
     */
    public function getPricesIngredient(): Collection
    {
        return $this->pricesIngredient;
    }

    public function addPricesIngredient(PricesIngredient $pricesIngredient): static
    {
        if (!$this->pricesIngredient->contains($pricesIngredient)) {
            $this->pricesIngredient->add($pricesIngredient);
            $pricesIngredient->setRestaurantCategory($this);
        }

        return $this;
    }

    public function removePricesIngredient(PricesIngredient $pricesIngredient): static
    {
        if ($this->pricesIngredient->removeElement($pricesIngredient)) {
            // set the owning side to null (unless already changed)
            if ($pricesIngredient->getRestaurantCategory() === $this) {
                $pricesIngredient->setRestaurantCategory(null);
            }
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
            $sizeProduct->setRestaurantCategory($this);
        }

        return $this;
    }

    public function removeSizeProduct(SizeProduct $sizeProduct): static
    {
        if ($this->sizeProduct->removeElement($sizeProduct)) {
            // set the owning side to null (unless already changed)
            if ($sizeProduct->getRestaurantCategory() === $this) {
                $sizeProduct->setRestaurantCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, FreeExtras>
     */
    public function getFreeExtras(): Collection
    {
        return $this->freeExtras;
    }

    public function addFreeExtra(FreeExtras $freeExtra): static
    {
        if (!$this->freeExtras->contains($freeExtra)) {
            $this->freeExtras->add($freeExtra);
            $freeExtra->setRestaurantCategory($this);
        }

        return $this;
    }

    public function removeFreeExtra(FreeExtras $freeExtra): static
    {
        if ($this->freeExtras->removeElement($freeExtra)) {
            // set the owning side to null (unless already changed)
            if ($freeExtra->getRestaurantCategory() === $this) {
                $freeExtra->setRestaurantCategory(null);
            }
        }

        return $this;
    }

    public function getQuantityFree(): ?int
    {
        return $this->quantityFree;
    }

    public function setQuantityFree(?int $quantityFree): static
    {
        $this->quantityFree = $quantityFree;

        return $this;
    }

    public function getTypeSize(): ?string
    {
        return $this->typeSize;
    }

    public function setTypeSize(?string $typeSize): static
    {
        $this->typeSize = $typeSize;

        return $this;
    }

}
