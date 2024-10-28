<?php

use App\Entity\FreeExtras;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FreeExtrasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Produkt',
            ])
            ->add('description', TextType::class, [
                'label' => 'Opis',
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
         $resolver->setDefaults([
             'data_class' => FreeExtras::class,
         ]);
    }
}
