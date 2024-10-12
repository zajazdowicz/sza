<?php

namespace App\Entity;

use App\Repository\RestaurantDetailsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantDetailsRepository::class)]
class RestaurantDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameRestaurant = null;

    #[ORM\Column(nullable: true)]
    private ?float $averageOpinion = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $minPurchaseAmount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    private ?string $minDeliveryAmount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logo = null;

    #[ORM\OneToOne(mappedBy: 'restaurantDetails', cascade: ['persist', 'remove'])]
    private ?Poi $poi = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    /**
     * @var Collection<int, CategoryKitchen>
     */
    #[ORM\ManyToMany(targetEntity: CategoryKitchen::class, inversedBy: 'restaurantDetails')]
    private Collection $categoryKitchen;

    #[ORM\OneToOne(inversedBy: 'restaurantDetails', cascade: ['persist', 'remove'])]
    private ?Address $address = null;

    /**
     * @var Collection<int, RestaurantOpinions>
     */
    #[ORM\ManyToMany(targetEntity: RestaurantOpinions::class, inversedBy: 'restaurantDetails')]
    private Collection $restaurantOpinions;

    /**
     * @var Collection<int, TypePayment>
     */
    #[ORM\ManyToMany(targetEntity: TypePayment::class, inversedBy: 'restaurantDetails')]
    private Collection $typePayments;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?RestaurantContactDetails $restaurantContactDetails = null;

    /**
     * @var Collection<int, RestaurantCategory>
     */
    #[ORM\ManyToMany(targetEntity: RestaurantCategory::class, inversedBy: 'restaurantDetails')]
    private Collection $restaurantCategory;

    public function __construct()
    {
        $this->categoryKitchen = new ArrayCollection();
        $this->restaurantOpinions = new ArrayCollection();
        $this->typePayments = new ArrayCollection();
        $this->restaurantCategory = new ArrayCollection();
        $this->restaurantContactDetails = new RestaurantContactDetails();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameRestaurant(): ?string
    {
        return $this->nameRestaurant;
    }

    public function setNameRestaurant(string $nameRestaurant): static
    {
        $this->nameRestaurant = $nameRestaurant;

        return $this;
    }

    public function getAverageOpinion(): ?float
    {
        return $this->averageOpinion;
    }

    public function setAverageOpinion(?float $averageOpinion): static
    {
        $this->averageOpinion = $averageOpinion;

        return $this;
    }

    public function getMinPurchaseAmount(): ?string
    {
        return $this->minPurchaseAmount;
    }

    public function setMinPurchaseAmount(?string $minPurchaseAmount): static
    {
        $this->minPurchaseAmount = $minPurchaseAmount;

        return $this;
    }

    public function getMinDeliveryAmount(): ?string
    {
        return $this->minDeliveryAmount;
    }

    public function setMinDeliveryAmount(?string $minDeliveryAmount): static
    {
        $this->minDeliveryAmount = $minDeliveryAmount;

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

    public function getPoi(): ?Poi
    {
        return $this->poi;
    }

    public function setPoi(?Poi $poi): static
    {
        // unset the owning side of the relation if necessary
        if ($poi === null && $this->poi !== null) {
            $this->poi->setRestaurantDetails(null);
        }

        // set the owning side of the relation if necessary
        if ($poi !== null && $poi->getRestaurantDetails() !== $this) {
            $poi->setRestaurantDetails($this);
        }

        $this->poi = $poi;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, CategoryKitchen>
     */
    public function getCategoryKitchen(): Collection
    {
        return $this->categoryKitchen;
    }

    public function addCategoryKitchen(CategoryKitchen $categoryKitchen): static
    {
        if (!$this->categoryKitchen->contains($categoryKitchen)) {
            $this->categoryKitchen->add($categoryKitchen);
        }

        return $this;
    }

    public function removeCategoryKitchen(CategoryKitchen $categoryKitchen): static
    {
        $this->categoryKitchen->removeElement($categoryKitchen);

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, RestaurantOpinions>
     */
    public function getRestaurantOpinions(): Collection
    {
        return $this->restaurantOpinions;
    }

    public function addRestaurantOpinion(RestaurantOpinions $restaurantOpinion): static
    {
        if (!$this->restaurantOpinions->contains($restaurantOpinion)) {
            $this->restaurantOpinions->add($restaurantOpinion);
        }

        return $this;
    }

    public function removeRestaurantOpinion(RestaurantOpinions $restaurantOpinion): static
    {
        $this->restaurantOpinions->removeElement($restaurantOpinion);

        return $this;
    }

    /**
     * @return Collection<int, TypePayment>
     */
    public function getTypePayments(): Collection
    {
        return $this->typePayments;
    }

    public function addTypePayment(TypePayment $typePayment): static
    {
        if (!$this->typePayments->contains($typePayment)) {
            $this->typePayments->add($typePayment);
        }

        return $this;
    }

    public function removeTypePayment(TypePayment $typePayment): static
    {
        $this->typePayments->removeElement($typePayment);

        return $this;
    }

    public function getRestaurantContactDetails(): ?RestaurantContactDetails
    {
        return $this->restaurantContactDetails;
    }

    public function setRestaurantContactDetails(?RestaurantContactDetails $restaurantContactDetails): static
    {
        $this->restaurantContactDetails = $restaurantContactDetails;

        return $this;
    }

    /**
     * @return Collection<int, RestaurantCategory>
     */
    public function getRestaurantCategory(): Collection
    {
        return $this->restaurantCategory;
    }

    public function addRestaurantCategory(RestaurantCategory $restaurantCategory): static
    {
        if (!$this->restaurantCategory->contains($restaurantCategory)) {
            $this->restaurantCategory->add($restaurantCategory);
        }

        return $this;
    }

    public function removeRestaurantCategory(RestaurantCategory $restaurantCategory): static
    {
        $this->restaurantCategory->removeElement($restaurantCategory);

        return $this;
    }
        public function __toString(): string
    {
        return $this->nameRestaurant;
    }
}
