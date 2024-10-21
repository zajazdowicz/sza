<?php

namespace App\Form;

use App\Form\DataTransformer\TextAreaToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class TextToObjectAreaType extends AbstractType
{
    public function __construct(
        private TextAreaToArrayTransformer $textAreaToArrayTransformer,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addModelTransformer($this->textAreaToArrayTransformer);
    }
    public function getParent()
    {
        return TextareaType::class; // Używamy Textarea jako typu bazowego
    }
}
