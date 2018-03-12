<?php
namespace App\Repository;

use App\Entity\Email;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class EmailRepository extends ServiceEntityRepository
{

    /**
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Email::class);
    }

    /**
     *
     * @param string $email
     * @return boolean
     */
    public function exists(string $email) : bool
    {
        return $this->createQueryBuilder('e')
            ->where('e.email = :email AND e.deleted IS NULL')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult() !== null;
    }
}
