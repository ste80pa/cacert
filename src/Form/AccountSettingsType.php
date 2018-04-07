<?php
namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountSettingsType extends AbstractType
{

    /**
     *
     * {@inheritdoc}
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
                    'label' => 'Password'
                ),
                'second_options' => array(
                    'label' => 'Repeat Password'
                )
            ])
            ->add('updatePassword', SubmitType::class)
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
            ->add('updateListing', SubmitType::class)
            ->add('securityQuestions', SecurityQuestionsType::class)
            ->add('updateQuestions', SubmitType::class);
        
           
    }

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Form\AbstractType::configureOptions()
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'error_bubbling' => false

        ]);
    }
}
