<?php

namespace App\Form;

use App\DTO\Subject\SubjectDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditSubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextType::class, [
                'required' => true,
                'label' => 'Descrição',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Editar',
                'attr' => [
                    'class' => 'btn-solid theme-warning'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubjectDto::class,
            'method' => 'PUT',
            'csrf_protection' => true
        ]);
    }
}
