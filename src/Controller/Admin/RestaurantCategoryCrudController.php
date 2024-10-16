<?php

namespace App\Controller\Admin;

use App\Entity\RestaurantCategory;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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
        ->join('r.customer', 'c')
        ->join('c.user', 'u')
        ->andWhere('u.id = :user')
        ->setParameter('user', $this->getUser());
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('nameCategory'),
            TextField::new('image'),
            BooleanField::new('isActive'),
            // TextEditorField::new('description'),
        ];
    }
    
}
