<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 *
 */
class UserRegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('middleName', TextType::class, [ 'required'   => false])
            ->add('lastName')
            ->add('nameSuffix', TextType::class, [ 'required'   => false])
            ->add('password', PasswordType::class, [ 'trim' => true])
            ->add('repeatedPassPhrase', PasswordType::class, [ 'trim' => true])
            ->add('email')
            ->add('dateOfBirth', BirthdayType::class)
            ->add(
                'agreement',
                ChoiceType::class,
                [
                    'expanded' => true,
                    'multiple' => true,
                    'choices' => [
                        'I agree to the terms and conditions of the CAcert Community Agreement: ' => true
                    ]
                ]
            )
            ->add('questions', SecurityQuestionsType::class)

            ->add('alerts', AlertsType::class)
            ->add('next', SubmitType::class, ['label' => 'Next']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => User::class,
        ]);
    }
}
