<?php

namespace App\Controller\Admin;

use App\Entity\PricesProduct;
use App\Entity\RestaurantCategory;
use App\Entity\User;
use App\Field\TextToObjectField;
use App\Form\IngredientsType;
use App\Form\PriceProductType;
use App\Form\PricesIngredientType;
use App\Form\ProductType;
use App\Form\SizeProductType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FreeExtrasType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RestaurantCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RestaurantCategory::class;
    }
    
 public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        return parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters)
        ->join('entity.restaurantDetails', 'r')
        ->join('r.users', 'u')
        ->andWhere('u.id = :user')
        ->setParameter('user', $this->getUser());
    }
    
    public function configureFields(string $pageName): iterable
    {

        if (Crud::PAGE_INDEX === $pageName) {
                  return [
            FormField::addTab('Kategoria'),
            TextField::new('nameCategory'),
            TextField::new('image'),
            BooleanField::new('active')];
    }else {
          $restaurantCategoryId = $this->getContext()->getEntity()->getInstance()->getId();
        return [
            FormField::addTab('Kategoria'),
            TextField::new('nameCategory'),
            TextField::new('image'),
            BooleanField::new('active'),

            FormField::addTab('Produkty w kategorii'),
            CollectionField::new('ingredients', "Produkty")
                ->setEntryType(IngredientsType::class)
                ->allowAdd(true)
                ->allowDelete(true),
                    FormField::addTab('Menu'),
            CollectionField::new('product', "Produkty")
                ->setEntryType(ProductType::class)
                ->allowAdd(true)
                ->allowDelete(true)
                ->setFormTypeOptions([
                'entry_options' => 
                    ['restaurant_category' => $restaurantCategoryId,] // Przekazujemy kategorię do formularza IngredientsType
            ]),
            FormField::addTab('Dane dotyczące produktów'),
            CollectionField::new('sizeProduct', "Produkty")
                ->setEntryType(SizeProductType::class)
                ->allowAdd(true)
                ->allowDelete(true)
                 ->formatValue(function ($value, $entity) {
            return  $entity->getSize();
        })
            //     ->setFormTypeOptions([
            //     'entry_options' => 
            //         ['restaurant_category' => $restaurantCategoryId,] // Przekazujemy kategorię do formularza IngredientsType
               
            // ])
            ,
            FormField::addTab('Cena składników'),
            CollectionField::new('pricesIngredient', 'Cena')
                ->setEntryType(PricesIngredientType::class)
                ->allowAdd()
                ->allowDelete()->setFormTypeOptions([
                'entry_options' => 
                    ['restaurant_category' => $restaurantCategoryId,] // Przekazujemy kategorię do formularza IngredientsType
               
                ]),
                FormField::addTab('Darmowe dodatki'),
                IntegerField::new('quantityFree', "Ilość wybrania gratisow"),
                CollectionField::new('freeExtras')
                    ->allowAdd()
                    ->allowDelete()
                    ->setEntryType(FreeExtrasType::class) 
                    ->setFormTypeOptions([
                        'by_reference' => false,
                    ])
        ];
        
    }
    } 
    // // Zaraz przed dodaniem
    public function persistEntity(EntityManagerInterface $entityManager, mixed $entityInstance): void
    {
        /** @var RestaurantCategory $entityInstance */
        $entityInstance = $entityInstance;
        $restaurantDetails = $entityInstance->getRestaurantDetails();
        $currentUser = $this->getUser();
    if ($currentUser instanceof User) { // Upewnij się, że użytkownik jest instancją odpowiedniej klasy
        // Pobierz restaurację powiązaną z zalogowanym użytkownikiem
        $restaurantDetails = $currentUser->getRestaurantDetails(); // Upewnij się, że masz odpowiednią metodę w User
            $entityInstance->addRestaurantDetail($restaurantDetails);
    }
            foreach ($restaurantDetails as $detail) {
                
                $entityInstance->addRestaurantDetail($detail);
        }
        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

 
}
