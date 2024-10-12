<?php

namespace App\Entity;

use App\Repository\RestaurantOpeningHoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantOpeningHoursRepository::class)]
class RestaurantOpeningHours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $start = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $finish = null;

    #[ORM\Column(nullable: true)]
    private ?int $day = null;

    #[ORM\Column(nullable: true)]
    private ?bool $allDay = null;

    /**
     * @var Collection<int, RestaurantDetails>
     */
    #[ORM\ManyToMany(targetEntity: RestaurantDetails::class, mappedBy: 'openingHours')]
    private Collection $restaurantDetails;

    public function __construct()
    {
        $this->restaurantDetails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): static
    {
        $this->start = $start;

        return $this;
    }

    public function getFinish(): ?\DateTimeInterface
    {
        return $this->finish;
    }

    public function setFinish(\DateTimeInterface $finish): static
    {
        $this->finish = $finish;

        return $this;
    }

    public function getDay(): ?int
    {
        return $this->day;
    }

    public function setDay(?int $day): static
    {
        $this->day = $day;

        return $this;
    }

    public function isAllDay(): ?bool
    {
        return $this->allDay;
    }

    public function setAllDay(?bool $allDay): static
    {
        $this->allDay = $allDay;

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
            $restaurantDetail->addOpeningHour($this);
        }

        return $this;
    }

    public function removeRestaurantDetail(RestaurantDetails $restaurantDetail): static
    {
        if ($this->restaurantDetails->removeElement($restaurantDetail)) {
            $restaurantDetail->removeOpeningHour($this);
        }

        return $this;
    }
         public function __toString(): string
    {
        return $this->getDayByNumber($this->day);
    }
    private function getDayByNumber($number) {
    $days = [
        1 => "Poniedziałek",
        2 => "Wtorek",
        3 => "Środa",
        4 => "Czwartek",
        5 => "Piątek",
        6 => "Sobota",
        7 => "Niedziela"
    ];

    return isset($days[$number]) ? $days[$number] : "Nieprawidłowy numer dnia";
}
}
