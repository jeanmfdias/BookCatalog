<?php

namespace App\Form;

use App\DTO\Book\BookDto;
use App\Entity\AuthorEntity;
use App\Entity\BookEntity;
use App\Entity\SubjectEntity;
use Dom\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => true,
                'label' => 'Título'
            ])
            ->add('publisher', TextType::class, [
                'required' => true,
                'label' => 'Editora',
            ])
            ->add('edition', IntegerType::class, [
                'required' => true,
                'label' => 'Edição',
                'attr' => [
                    'min' => 1
                ]
            ])
            ->add('published_year', IntegerType::class, [
                'required' => true,
                'label' => 'Ano de publicação',
                'attr' => [
                    'placeholder' => '1900',
                    'min' => 0,
                    'max' => 9999
                ]
            ])
            ->add('price', MoneyType::class, [
                'required' => false,
                'label' => 'Valor (R$)',
                'currency' => 'BRL',
                'attr' => [
                    'placeholder' => '0,00',
                    'class' => 'form-control',
                ],
            ])
            ->add('authors', EntityType::class, [
                'class' => AuthorEntity::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
                'label' => 'Autores',
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
            ])
            ->add('subjects', EntityType::class, [
                'class' => SubjectEntity::class,
                'choice_label' => 'description',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
                'label' => 'Assuntos',
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Salvar',
                'attr' => [
                    'class' => 'btn-solid theme-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookDto::class,
            'crsf_protection' => true,
            'method' => 'POST',
        ]);
    }
}
