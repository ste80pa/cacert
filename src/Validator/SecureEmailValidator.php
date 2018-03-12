<?php

namespace App\Validator;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Entity\Email;
use App\Entity\User;
use App\Validator\Constraints\SecureEmail;
use Doctrine\Bundle\DoctrineBundle\Registry;

/**
 * 
 * @author Stefano Pallozzi
 *
 */
class SecureEmailValidator extends ConstraintValidator
{  
    /**
     *
     * @var Registry
     */
    private $doctrine;
    
    /**
     * 
     * @var TokenStorage
     */
    private $tokenStorage;
    
    /**
     *
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine, TokenStorage $tokenStorage)
    {
        $this->doctrine = $doctrine;
        $this->tokenStorage = $tokenStorage;
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Symfony\Component\Validator\ConstraintValidatorInterface::validate()
     */
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint SecureEmail */
        /* @var $user User */
        
        $user = $this->tokenStorage->getToken()->getUser();
        
        if($constraint->allow_punycode === false)
        {
            if(strstr($value, 'xn--') !== false && !$user->getCodesign())
            {
                $this->context->buildViolation($constraint->punycode_message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
            }
        }
        
        if (false !== $this->doctrine->getRepository(Email::class)->exists($value)) {
            $this->context->buildViolation($constraint->exist_message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
        }
        
    }
}
