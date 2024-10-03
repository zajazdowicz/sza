<?php

namespace App\Service;

use App\Repository\PoiRepository;
use Symfony\Component\HttpClient\HttpClient;

class PoiService
{
   public function __construct(private PoiRepository $PoiRepository) {

   }
    public function getWizytowka(array $ids): array
    {
        //dd($ids);
        return $this->PoiRepository->findWizytyokwa($ids);

    }

    public function getPunktWithinRadius($lat, $lon, $radius)
    {
        return $this->PoiRepository->getPunktWithinRadius($lat, $lon, $radius);
    }


    public function getWizytowkaByCoordinates($lat, $lon, $radius)
    {
        return $this->PoiRepository->getPunktWithinRadius($lat, $lon, $radius);
    }

}
