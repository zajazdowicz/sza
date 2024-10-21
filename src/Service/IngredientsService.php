<?php

namespace App\Service;

use App\Entity\Ingredients;
use App\Repository\IngredientsRepository;
use App\Repository\PoiRepository;
use Symfony\Component\HttpClient\HttpClient;

class IngredientsService
{
   public function __construct(private IngredientsRepository $ingredientsRepository) {

   }
    public function getIngredientsByNames(array $ids): array
    {
        //dd($ids);
        return $this->ingredientsRepository->findtIngredientsByNames($ids);

    }

 public function save(Ingredients $ingredients, bool $flush): void
    {
        //dd($ids);
         $this->ingredientsRepository->save($ingredients,$flush);

    }
    
}
