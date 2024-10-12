<?php

namespace App\Form;

use App\Entity\RestaurantOpeningHours;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\VarDumper\Cloner\Data;

class OpenHoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day', ChoiceType::class, [
                'label' => 'Dzień',
                'choices'  => [
                    'Poniedziałek' => 1,
                    'Wtorek' => 2,
                    'Środa' => 3,
                    'Czwartek' => 4,
                    'Piątek' => 5,
                    'Sobota' => 6,
                    'Niedziela' => 7,
                ],  
            ])
            ->add('start', TimeType::class, [
                'label' => 'Godzina otwarcia',
            ])
            ->add('finish', TimeType::class, [
                'label' => 'Godzina zamknięcia',
            ])
            ->add('allDay', CheckboxType::class, [
                'label' => 'Domyslne godziny dla calego tygodnia',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
         $resolver->setDefaults([
             'data_class' => RestaurantOpeningHours::class,
         ]);
    }
}
