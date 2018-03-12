<?php

namespace App\Form;

use App\Entity\AddLang;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LanguageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lang')
            ->add('remove', ButtonType::class, [
                'label' => 'Remove',
                 'attr' => [
                     'class' => 'cacert-remove-button btn-danger pull-right'
                     ]
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => AddLang::class,
        ]);
    }
}
