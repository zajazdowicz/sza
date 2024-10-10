<?php

namespace App\Controller\Admin;

use App\Entity\Poi;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PoiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Poi::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('restaurantDetails'),
            TextField::new('lat'),
            TextField::new('lon'),
        ];
    }
}
