<?php

namespace App\Form;

use App\DTO\Subject\FilterDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubjectFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('search', TextType::class, [
                'label' => 'Descrição/ID',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Buscar por descrição ou ID'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilterDto::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }
}
