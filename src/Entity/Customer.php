<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $nick = null;

    #[ORM\Column(length: 64)]
    private ?string $customerType = null;

    #[ORM\Column]
    private ?bool $isSubaccount = null;

    /**
     * @var Collection<int, RestaurantDetails>
     */
    #[ORM\OneToMany(targetEntity: RestaurantDetails::class, mappedBy: 'customer')]
    private Collection $restaurantDetails;

    // /**
    //  * @var Collection<int, User>
    //  */
    // #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'customer')]
    // private Collection $user;

    public function __construct()
    {
        $this->restaurantDetails = new ArrayCollection();
        //$this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNick(): ?string
    {
        return $this->nick;
    }

    public function setNick(?string $nick): static
    {
        $this->nick = $nick;

        return $this;
    }

    public function getCustomerType(): ?string
    {
        return $this->customerType;
    }

    public function setCustomerType(string $customerType): static
    {
        $this->customerType = $customerType;

        return $this;
    }

    public function isSubaccount(): ?bool
    {
        return $this->isSubaccount;
    }

    public function setSubaccount(bool $isSubaccount): static
    {
        $this->isSubaccount = $isSubaccount;

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
            $restaurantDetail->setCustomer($this);
        }

        return $this;
    }

    public function removeRestaurantDetail(RestaurantDetails $restaurantDetail): static
    {
        if ($this->restaurantDetails->removeElement($restaurantDetail)) {
            // set the owning side to null (unless already changed)
            if ($restaurantDetail->getCustomer() === $this) {
                $restaurantDetail->setCustomer(null);
            }
        }

        return $this;
    }

    // /**
    //  * @return Collection<int, User>
    //  */
    // public function getUser(): Collection
    // {
    //     return $this->user;
    // }

    // public function addUser(User $user): static
    // {
    //     if (!$this->user->contains($user)) {
    //         $this->user->add($user);
    //         $user->setCustomer($this);
    //     }

    //     return $this;
    // }

    // public function removeUser(User $user): static
    // {
    //     if ($this->user->removeElement($user)) {
    //         // set the owning side to null (unless already changed)
    //         if ($user->getCustomer() === $this) {
    //             $user->setCustomer(null);
    //         }
    //     }

    //     return $this;
    // }
}
