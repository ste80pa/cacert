<?php

namespace App\Form;

use App\Entity\User;
use App\Form\SecurityQuestionsType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('listme', ChoiceType::class, [
                    'expanded' => true,
                    'multiple' => false,
                    'choices' => [
                        'Yes' => true,
                        'No' => false,
                    ],
                    'empty_data' => false,
                    'label' => 'My Property',
            ])
            ->add('contactinfo', TextareaType::class, ['required' => false])
            

            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))

            ->add('questions', SecurityQuestionsType::class)
            ->add('languages', CollectionType::class, [
                'entry_type' => LanguageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'entry_options' => ['label' => false],
                'label' => false
            ])
            ->add('add', ButtonType::class, ['attr' => ['class'=>'cacert-add-lang btn-success']])
            ->add('alerts', AlertsType::class, ['label' => false])
            ->add('save', SubmitType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
