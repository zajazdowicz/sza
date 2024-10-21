<?php

namespace App\Form\DataTransformer;

use App\Entity\Ingredients;
use App\Entity\Product;
use App\Service\IngredientsService;
use App\Service\ProductService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * @implements DataTransformerInterface<Ingredients[], string>
 */
class TextAreaToArrayTransformer implements DataTransformerInterface
{
    public function __construct(private IngredientsService $ingredientsService)
    {
    }
    /**
     * Transforms a string object to a array.
     * @param string|null $valueString
     * @return Ingredients[]
     */
    public function reverseTransform($valueString): array
    {
        $skus = [];
        if ($valueString == null) {
            return [];
        }

$names = array_map('trim', explode(',', $valueString)); // Rozbij tekst po przecinkach
    $ingredients = [];

    foreach ($names as $name) {
        // Sprawdź, czy składnik istnieje
        //$ingredient = $this->ingredientsService->findIngredientByName($name);
        
       
            // Jeśli nie istnieje, utwórz nowy składnik
            $ingredient = new Ingredients();
            $ingredient->setName($name);
            // Ustaw domyślną wartość isAddon, jeśli to potrzebne// lub true, w zależności od potrzeb
            // Zapisz składnik do bazy danych
            $this->ingredientsService->save($ingredient, true);
        

        $ingredients[] = $ingredient;
    }
                // Jeśli liczba znalezionych encji nie odpowiada liczbie SKU, zgłoś błąd
        // if (count($entities) !== count($skus)) {
        //     throw new TransformationFailedException('Niektóre SKU są nieprawidłowe.');
        // }
        //}

        return $ingredients;
    }

    /**
     * Transforms a array back to a string.
     *
     * @param Ingredients[]|null $products
     * @return string
     */
    public function transform($products): string
    {
        $skus = [];
        if ($products === null or count($products) == 0) {
            return '';
        }
        foreach ($products as $value) {
            $skus[] = $value->getName();
        }

        return implode(',', $skus);
    }
}
