<?php

namespace App\Controller\Admin;

use App\Entity\Poi;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PoiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Poi::class;
    }

 public function createIndexQueryBuilder(SearchDto  $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        
        return  parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters)
        ->join('entity.restaurantDetails', 'r')
        ->join('r.users', 'u')
        ->andWhere('u.id = :user')
        ->setParameter('user', $this->getUser());
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id'),
            TextField::new('lat'),
            TextField::new('lon'),
            
        ];
    }
    public function persistEntity(EntityManagerInterface $entityManager, mixed $entityInstance): void
{
    /** @var Poi $entityInstance */
        $entityInstance = $entityInstance;
        $currentUser = $this->getUser();
            if ($currentUser instanceof User) { // Upewnij się, że użytkownik jest instancją odpowiedniej klasy
                if($currentUser->getRestaurantDetails() != null){
                     $entityInstance->setRestaurantDetails($currentUser->getRestaurantDetails());
                }
            }
        parent::updateEntity($entityManager, $entityInstance);
}
}
