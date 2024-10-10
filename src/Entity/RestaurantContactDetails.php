<?php

namespace App\Entity;

use App\Repository\RestaurantContactDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RestaurantContactDetailsRepository::class)]
class RestaurantContactDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 64, nullable: true)]
    private ?string $tin = null;

    #[ORM\Column(length: 16)]
    private ?string $phoneSms = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $phoneSms2 = null;

    #[ORM\Column(length: 16, nullable: true)]
    private ?string $phoneOwner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTin(): ?string
    {
        return $this->tin;
    }

    public function setTin(?string $tin): static
    {
        $this->tin = $tin;

        return $this;
    }

    public function getPhoneSms(): ?string
    {
        return $this->phoneSms;
    }

    public function setPhoneSms(string $phoneSms): static
    {
        $this->phoneSms = $phoneSms;

        return $this;
    }

    public function getPhoneSms2(): ?string
    {
        return $this->phoneSms2;
    }

    public function setPhoneSms2(?string $phoneSms2): static
    {
        $this->phoneSms2 = $phoneSms2;

        return $this;
    }

    public function getPhoneOwner(): ?string
    {
        return $this->phoneOwner;
    }

    public function setPhoneOwner(?string $phoneOwner): static
    {
        $this->phoneOwner = $phoneOwner;

        return $this;
    }
     public function __toString(): string
    {
        return $this->tin;
    }
}
