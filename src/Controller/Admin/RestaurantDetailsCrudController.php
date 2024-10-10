<?php

namespace App\Controller\Admin;

use App\Entity\RestaurantContactDetails;
use App\Entity\RestaurantDetails;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RestaurantDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RestaurantDetails::class;
    }

    
    public function configureFields(string $pageName): iterable
    {

        if (Crud::PAGE_INDEX === $pageName) {
            return [

                TextField::new('nameRestaurant'),

            ];
        }else {
            return [
                FormField::addTab('Podstawowe'),
                TextField::new('nameRestaurant', "Nazwa restauracji"),
                TextField::new('restaurantContactDetails.tin', "Nip"),
                NumberField::new('averageOpinion', "Średnia ocen")->setDisabled(),
                NumberField::new('minPurchaseAmount', "Minimalna kwota zakupu"),
                TextField::new('minDeliveryAmount', "Minimalna kwota dostawy"),
                ImageField::new('logo', "Logo")->setUploadDir("/public/assets/images/logo"),
                FormField::addTab('Dane kontaktowe'),
                TextField::new('restaurantContactDetails.phoneSms', "Numer podstawowy"),
                TextField::new('restaurantContactDetails.phoneSms2', "Numer rezerwowy"),
                TextField::new('restaurantContactDetails.phoneOwner', "Numer właściciela"),
                FormField::addTab('Ustaw kategorie'),
                AssociationField::new('categoryKitchen')
                
            ];
        }
    }
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
{
    if ($entityInstance instanceof RestaurantDetails) {
        $restaurantContactDetails = new RestaurantContactDetails();
        $entityInstance->setRestaurantContactDetails($restaurantContactDetails);
        
    }

    parent::persistEntity($entityManager, $entityInstance);
}
    
}
