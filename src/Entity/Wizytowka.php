<?php

namespace App\Entity;




class Wizytowka 
{
    public function __construct(
        private string $lat,
        private string $lon,
        private ?string $id_openstreetmap = null,
        private ?string $name = null,
        private ?string $desc = null,
        private ?string $image = null,
        private ?bool $partner = false,

    )
    {
        
    }
    public function toArray(): array
    {
        return [
            'lat' => $this->lat,
            'lon' => $this->lon,
            'id_openstreetmap' => $this->id_openstreetmap,
            'name' => $this->name,
            'desc' => $this->desc,
            'image' => $this->image,
            'partner' => $this->partner
        ];
    }
}
