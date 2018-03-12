<?php
namespace App\Repository;

use App\Entity\Domains;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 *
 * @author Stefano Pallozzi
 *        
 */
class DomainsRepository extends ServiceEntityRepository
{
    /**
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Domains::class);
    }

    /**
     *
     * @param string $domain
     * @return boolean
     */
    public function exists(string $domain) : bool
    {
        return $this->createQueryBuilder('d')
            ->where('d.domain = :domain AND d.deleted IS NULL')
            ->setParameter('domain', $domain)
            ->getQuery()
            ->getOneOrNullResult() !== null;
    }
}
