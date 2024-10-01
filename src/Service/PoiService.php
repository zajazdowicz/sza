<?php

namespace App\Service;

use App\Repository\POIRepository;
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
}
