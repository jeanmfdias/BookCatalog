<?php

namespace App\Form;

use App\DTO\Book\BookDto;
use App\Entity\AuthorEntity;
use App\Entity\BookEntity;
use App\Entity\SubjectEntity;
use Dom\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
            ->add('edition', TextType::class, [
                'required' => true,
                'label' => 'Edição',
            ])
            ->add('published_year', TextType::class, [
                'required' => true,
                'label' => 'Ano de publicação',
            ])
            ->add('price', TextType::class, [
                'required' => false,
                'label' => 'Valor (R$)'
            ])
            ->add('authors', EntityType::class, [
                'class' => AuthorEntity::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
                'label' => 'Autor(es)',
                'attr' => ['class' => 'form-select'],
            ])
            ->add('subjects', EntityType::class, [
                'class' => SubjectEntity::class,
                'choice_label' => 'description',
                'multiple' => true,
                'expanded' => false,
                'by_reference' => false,
                'label' => 'Assunto(s)',
                'attr' => ['class' => 'form-select'],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Salvar'
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
