<?php

namespace App\Form;

use App\Entity\Alerts;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
/**
 * 
 * @author Stefano Pallozzi
 *
 */
class AlertsType extends AbstractType
{
    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('general')
            ->add('country')
            ->add('regional')
            ->add('radius')
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
            'data_class' => Alerts::class,
        ]);
    }
}
