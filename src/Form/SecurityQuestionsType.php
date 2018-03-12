<?php

namespace App\Form;
use App\Entity\SecurityQuestions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SecurityQuestionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('question1')
        ->add('question2')
        ->add('question3')
        ->add('question4')
        ->add('question5')
        ->add('answer1')
        ->add('answer2')
        ->add('answer3')
        ->add('answer4')
        ->add('answer5')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => SecurityQuestions::class,
        ]);
    }
}
