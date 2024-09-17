<?php

namespace App\Controller\Admin;

use App\Entity\POI;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class POICrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return POI::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            // IdField::new(propertyName: 'id'),
            TextField::new(propertyName: 'name'),
            //TextEditorField::new('description'),
        ];
    }
}
