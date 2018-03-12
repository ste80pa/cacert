<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints as CacertAssert;
/**
 * @link http://wiki.cacert.org/Software/Database/StructureDefined#Domains
 * @ORM\Entity(repositoryClass="App\Repository\DomainsRepository")
 */
class Domains
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * Foreign key to table Users, associated account.
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="domains")
     * @ORM\JoinColumn(name="memid", nullable=true)
     */
    private $user;
    
    /**
     * @CacertAssert\Domain()
     * @ORM\Column(type="string", name="domain", length=255)
     */
    private $domain;
    
    /**
     * @ORM\Column(type="datetime", name="created", nullable=true, options={"default"="CURRENT_TIMESTAMP"} )
     */
    private $created;
    
    /**
     * @ORM\Column(type="datetime", name="modified", nullable=true)
     */
    private $modified;
    
    /**
     * Timestamp of deletion, is set if the user deletes the mail address from his/her account.
     * @ORM\Column(type="datetime", name="deleted", nullable=true)
     */
    private $deleted;
    
    
    /**
     * @ORM\Column(type="string", name="hash", length=50, nullable=true)
     */
    private $hash;
    
  
    
    /**
     * @ORM\Column(type="integer", name="attempts", length=1,options={"default"=0})
     */
    private $attempts = 0;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @return mixed
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * @return mixed
     */
    public function getAttempts()
    {
        return $this->attempts;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * @param mixed $modified
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
    }

    /**
     * @param mixed $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * @param mixed $hash
     */
    public function setHash($hash)
    {
        $this->hash = $hash;
    }

    /**
     * @param mixed $attempts
     */
    public function setAttempts($attempts)
    {
        $this->attempts = $attempts;
    }

    
}
