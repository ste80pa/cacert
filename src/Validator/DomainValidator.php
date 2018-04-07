<?php
namespace App\Validator;

use App\Validator\Constraints\Domain;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Entity\Domains;
use App\Entity\OrgDomains;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

/**
 * @link https://www.wordfence.com/blog/2017/04/chrome-firefox-unicode-phishing/
 * @author Stefano Pallozzi
 *        
 */
class DomainValidator extends ConstraintValidator
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
     * {@inheritdoc}
     * @see \Symfony\Component\Validator\ConstraintValidatorInterface::validate()
     */
    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint Domain */
        /* @var $user User */
        if ($constraint->allow_null_bytes_domain === false) {
            if (strstr($value, "\x00") !== false) {
                $this->context->buildViolation($constraint->null_bytes_message)
                    ->setParameter('{{ value }}', $value)
                    ->addViolation();
            }
        }

        list ($domain) = explode(' ', $value, 2);

        while ($domain['0'] == '-') {
            $domain = substr($domain, 1);
        }

        $user = $this->tokenStorage->getToken()->getUser();

        if ($constraint->allow_punycode === false) {
            if (strstr($value, 'xn--') !== false && ! $user->getCodesign()) {
                $this->context->buildViolation($constraint->punycode_message)
                    ->setParameter('{{ value }}', $value)
                    ->addViolation();
            }
        }

        if (false !== $this->doctrine->getRepository(Domains::class)->exists($value) ||
            null !== $this->doctrine->getRepository(OrgDomains::class)->findOneByDomain($value)) {
            $this->context->buildViolation($constraint->exist_message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }
}
