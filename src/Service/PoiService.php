<?php

namespace App\Service;

use App\Repository\POIRepository;
use Symfony\Component\HttpClient\HttpClient;

class PoiService
{
   public function __construct(private POIRepository $pOIRepository) {

   }
    public function getWizytowka(array $ids): array
    {
        //dd($ids);
        return $this->pOIRepository->findWizytyokwa($ids);

    }
}
