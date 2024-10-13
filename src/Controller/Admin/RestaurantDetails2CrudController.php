<?php

namespace App\Controller\Admin;

use App\Entity\RestaurantDetails;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RestaurantDetails2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RestaurantDetails::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nameCategory'),
            TextField::new('image'),
            BooleanField::new('isActive'),
        ];
    }
    
}
