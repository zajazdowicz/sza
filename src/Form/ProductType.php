<?php

namespace App\Form;

use App\Entity\Ingredients;
use App\Entity\Product;
use App\Entity\RestaurantOpeningHours;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\IntegerType as TypesIntegerType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\VarDumper\Cloner\Data;

class ProductType extends AbstractType
{          public function __construct(private EntityManagerInterface $entityManager)
    {
        
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
 $restaurantCategory = $options['restaurant_category'] ?? null;
     $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa produktu',  
            ])
            ->add('description', TextType::class, [
                'label' => 'Opis',
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredients::class, // Klasa encji, z której będą pochodziły składniki
                'choice_label' => 'name', // Pole, które będzie wyświetlane w liście
                'multiple' => true, // Umożliwia wybór wielu składników
                'expanded' => true, // Umożliwia wyświetlenie jako dropdown\
                'query_builder' => function() use ($options)  {
                    $category = $options['restaurant_category'];
                    return $this->entityManager->createQueryBuilder()
                        ->select('i')
                        ->from(Ingredients::class, 'i')
                        ->where('i.restaurantCategory = :category')
                        ->setParameter('category', $category); // Filtrowanie po kategorii
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
       
         $resolver->setDefaults([
             'data_class' => Product::class,
             'restaurant_category' => '', // Domyślny parametr
         ]);
    }
}
