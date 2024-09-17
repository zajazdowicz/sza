<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'reviews')]
    private ?POI $poi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPoi(): ?POI
    {
        return $this->poi;
    }

    public function setPoi(?POI $poi): static
    {
        $this->poi = $poi;

        return $this;
    }
}
