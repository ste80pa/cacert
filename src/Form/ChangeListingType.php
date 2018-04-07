<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * 
 * @author Stefano Pallozzi
 *
 */
class ChangeListingType extends AbstractType
{
    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('listme', ChoiceType::class,
            [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'Yes' => true,
                    'No' => false
                ],
                'empty_data' => false,
                'label' => 'My Property'
            ])
            ->add('contactinfo', TextareaType::class, ['required' => false])
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
