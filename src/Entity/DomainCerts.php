<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DomainCertsRepository")
 */
class DomainCerts
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     *
     */
    private $domid;
    /**
     *
     */
    private $serial;
    /**
     *
     */
    private $CN;
    /**
     *
     */
    private $subject;
    /**
     *
     */
    private $csr_name;
    /**
     *
     */
    private $crt_name;
    /**
     *
     */
    private $created;
    /**
     *
     */
    private $modified;
    /**
     *
     */
    private $revoked;
    /**
     *
     */
    private $expire;
    /**
     *
     */
    private $warning;
    /**
     *
     */
    private $renewed;
    /**
     *
     */
    private $rootcert;
    /**
     *
     */
    private $md;
    /**
     *
     */
    private $type;
    /**
     *
     */
    private $pkhash;
    /**
     *
     */
    private $certhash;
    /**
     *
     */
    private $coll_found;
    /**
     *
     */
    private $description;
}
