<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * 
 * @author Stefano Pallozzi
 *
 */
class ChangeLanguagesType extends AbstractType
{
    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('languages', CollectionType::class,
            [
                'entry_type' => LanguageType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'entry_options' => [
                    'label' => false
                ],
                'label' => false
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
