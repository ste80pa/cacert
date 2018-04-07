<?php
namespace App\Form;

use App\Entity\SecurityQuestions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class SecurityQuestionsType extends AbstractType
{

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Form\AbstractType::buildForm()
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('question1')
            ->add('question2')
            ->add('question3')
            ->add('question4')
            ->add('question5')
            ->add('answer1')
            ->add('answer2')
            ->add('answer3')
            ->add('answer4')
            ->add('answer5');
    }

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SecurityQuestions::class,
            'error_bubbling' => false

        ]);
    }
}
