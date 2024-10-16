<?php

namespace App\Service;

use App\Entity\RestaurantDetails;
use App\Repository\PoiRepository;
use App\Repository\RestaurantDetailsRepository;
use Symfony\Component\HttpClient\HttpClient;

class RestaurantDetailsService
{
   public function __construct(private RestaurantDetailsRepository $restaurantDetailsRepository) {

   }
    public function getWizytowka(int $id): RestaurantDetails
    {
        return $this->restaurantDetailsRepository->findWizytowka($id);
    }
    public function getRestauranByCustomerId(int $id): RestaurantDetails
    {
        return $this->restaurantDetailsRepository->findRestauranByCustomerId($id);
    }

    
}
