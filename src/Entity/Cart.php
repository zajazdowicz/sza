<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    private ?RestaurantDetails $restaurantDetails = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    private ?User $users = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $priceDelivery = null;

    /**
     * @var Collection<int, CartItem>
     */
    #[ORM\ManyToMany(targetEntity: CartItem::class)]
    private Collection $cartItem;

    public function __construct()
    {
        $this->cartItem = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): static
    {
        $this->users = $users;

        return $this;
    }

    public function getPriceDelivery(): ?string
    {
        return $this->priceDelivery;
    }

    public function setPriceDelivery(string $priceDelivery): static
    {
        $this->priceDelivery = $priceDelivery;

        return $this;
    }

    /**
     * @return Collection<int, CartItem>
     */
    public function getCartItem(): Collection
    {
        return $this->cartItem;
    }

    public function addCartItem(CartItem $cartItem): static
    {
        if (!$this->cartItem->contains($cartItem)) {
            $this->cartItem->add($cartItem);
        }

        return $this;
    }

    public function removeCartItem(CartItem $cartItem): static
    {
        $this->cartItem->removeElement($cartItem);

        return $this;
    }
}
