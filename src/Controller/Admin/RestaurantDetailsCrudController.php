<?php

namespace App\Controller\Admin;

use App\Entity\RestaurantContactDetails;
use App\Entity\RestaurantDetails;
use App\Entity\User;
use App\Form\OpenHoursType;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Orm\EntityRepository;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RestaurantDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return RestaurantDetails::class;
    }
    
    

    // Wstrzyknięcie AdminUrlGenerator przez konstruktor
    public function __construct(private AdminUrlGenerator $adminUrlGenerator, private EntityManagerInterface $entityManager)
    {
        
    }
  public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
       
        return parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters)
        ->join('entity.customer', 'c')
        ->join('c.user', 'u')
        ->andWhere('u.id = :user')
        ->setParameter('user', $this->getUser());
    }


    public function index(AdminContext $context)
    {
        $currentUser = $this->getUser();
    if ($currentUser instanceof User) { // Upewnij się, że użytkownik jest instancją odpowiedniej klasy
        $restauran = $currentUser->getRestaurantDetails();
    }
    if($restauran !=null ){
                $restauranId = $restauran->getId();
           $url = $this->adminUrlGenerator
            ->setController(self::class)
            ->setAction('edit') // Ustawiamy akcję tworzenia nowego rekordu
            ->setEntityId($restauranId) 
            ->generateUrl();
           
    }else {
        $url = $this->adminUrlGenerator
            ->setController(self::class)
            ->setAction('new') // Ustawiamy akcję tworzenia nowego rekordu
            ->generateUrl();
            
    }
        return $this->redirect($url);
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
                TextField::new('address.city', "Miasto"),
                TextField::new('address.street', "Ulica"),
                TextField::new('address.streetNumber', "Numer ulicy"),
                TextField::new('restaurantContactDetails.phoneSms', "Numer podstawowy"),
                TextField::new('restaurantContactDetails.phoneSms2', "Numer rezerwowy"),
                TextField::new('restaurantContactDetails.phoneOwner', "Numer właściciela"),
                FormField::addTab('Ustaw kategorie'),
                AssociationField::new('categoryKitchen'),
                FormField::addTab('Godziny otwarcia'),
                CollectionField::new('openingHours', "Godziny otwarcia")
                ->setEntryType(OpenHoursType::class)
                ->allowAdd(true)
                ->allowDelete(true),

                
            ];
        }
    }
        public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
        
    {
        /** @var RestaurantDetails $entityInstance */
        $entityInstance = $entityInstance;
        $currentUser = $this->getUser();
            if ($currentUser instanceof User) { // Upewnij się, że użytkownik jest instancją odpowiedniej klasy

                $entityInstance->addUser($currentUser);
            }

        $entityInstance->setSlug(str_replace(' ', '_', $entityInstance->getNameRestaurant()));
        parent::updateEntity($entityManager, $entityInstance);
    }



}
