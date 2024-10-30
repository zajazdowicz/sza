<?php

namespace App\Entity;

use App\Repository\SizeProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SizeProductRepository::class)]
class SizeProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64)]
    private ?string $size = null;

    // #[ORM\Column(length: 64)]
    // private ?string $type = null;

    /**
     * @var Collection<int, PricesIngredient>
     */
    #[ORM\ManyToMany(targetEntity: PricesIngredient::class, mappedBy: 'sizeProduct')]
    private Collection $pricesIngredients;

    #[ORM\ManyToOne(inversedBy: 'sizeProduct')]
    private ?RestaurantCategory $restaurantCategory = null;

    public function __construct()
    {
        $this->pricesIngredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): static
    {
        $this->size = $size;

        return $this;
    }

    // public function getType(): ?string
    // {
    //     return $this->type;
    // }

    // public function setType(string $type): static
    // {
    //     $this->type = $type;

    //     return $this;
    // }

    /**
     * @return Collection<int, PricesIngredient>
     */
    public function getPricesIngredients(): Collection
    {
        return $this->pricesIngredients;
    }

    public function addPricesIngredient(PricesIngredient $pricesIngredient): static
    {
        if (!$this->pricesIngredients->contains($pricesIngredient)) {
            $this->pricesIngredients->add($pricesIngredient);
            $pricesIngredient->addSizeProduct($this);
        }

        return $this;
    }

    public function removePricesIngredient(PricesIngredient $pricesIngredient): static
    {
        if ($this->pricesIngredients->removeElement($pricesIngredient)) {
            $pricesIngredient->removeSizeProduct($this);
        }

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
