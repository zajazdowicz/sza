<?php

namespace App\Form;

use App\Entity\Ingredients;
use App\Entity\PricesIngredient;
use App\Entity\Product;
use App\Entity\RestaurantOpeningHours;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\DBAL\Types\IntegerType as TypesIntegerType;
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

class IngredientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa produktu',  
            ])
            ->add('isAddon',CheckboxType::class, [
                'label' => 'Czy ma byc pokazywany jako dodtatek?',
                'required' => false, // Ustaw na false, aby pole nie było wymagane

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
         $resolver->setDefaults([
             'data_class' => Ingredients::class,
         ]);
    }
}
