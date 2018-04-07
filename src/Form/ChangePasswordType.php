<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @link https://symfony.com/doc/current/best_practices/forms.html
 * @author Stefano Pallozzi
 *
 */
class ChangePasswordType extends AbstractType
{
    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('plainPassword', RepeatedType::class,
            [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => array(
                    'attr' => array(
                        'class' => 'password-field'
                    )
                ),
                'required' => true,
                'first_options' => array(
                    'label' => 'settings.password.label'
                ),
                'second_options' => array(
                    'label' => 'settings.password.repeat_label'
                )
            ])
        ;
    }

    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'account'
        ]);
    }
}
