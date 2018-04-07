<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints as CacertAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @link http://wiki.cacert.org/Software/Database/StructureDefined#Email
 * Contains a list of all mail adresses (including the primary one named in the Users table)
 *  associated to user accounts.
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="App\Repository\EmailRepository")
 */
class Email
{
    /**
     * @Groups({"api"})
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     */
    private $id;

    /**
     * Foreign key to table Users, associated account.
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="emails")
     * @ORM\JoinColumn(name="memid", nullable=true)
     */
    private $user;

    /**
     * @Groups({"api"})
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true,
     *     checkHost = true
     * )
     * @CacertAssert\SecureEmail()
     * @ORM\Column(type="string", name="email", length=255)
     * 
     */
    private $email;


    /**
     * @Groups({"api"})
     * @ORM\Column(type="datetime", name="created", nullable=true)
     * @Assert\DateTime()
     */
    private $created;

    /**
     * @Groups({"api"})
     * @ORM\Column(type="datetime", name="modified", nullable=true)
     */
    private $modified;

    /**
     * Timestamp of deletion, is set if the user deletes the mail address from his/her account.
     * @Groups({"api"})
     * @ORM\Column(type="datetime", name="deleted", nullable=true)
     */
    private $deleted;

    /**
     * If a new mail address is added the verification hash is stored here until the mail address has been verified.
     * So email.hash = ' ' is a restriction that finds only verified mails.
     * @ORM\Column(type="string", name="hash", length=50, nullable=true)
     */
    private $hash;

    /**
     * 
     * For verification process?
     * @Groups({"api"})
     * @ORM\Column(type="integer", name="attempts", length=1, options={"default":0})
     */
    private $attempts = 0;

    /**
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->created = new \DateTime();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->modified = new \DateTime();
    }
    
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get foreign key to table Users, associated account
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set foreign key to table Users, associated account
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of created
     */
    public function getCreated()
    {
        return $this->created;
    }

    

    /**
     * Get the value of modified
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Get timestamp of deletion, is set if the user deletes the mail address from his/her account.
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

   /**
    * 
    * @return boolean
    */
    public function isDeleted() : bool
    {
        return $this->deleted === null;
    }

    /**
     * Get if a new mail address is added the verification hash is stored here until the mail address has been verified.
     */
    public function getHash() : string
    {
        return $this->hash;
    }

    /**
     * Set if a new mail address is added the verification hash is stored here until the mail address has been verified.
     *
     * @return  self
     */
    public function setHash(string $hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get for verification process?
     */
    public function getAttempts()
    {
        return $this->attempts;
    }

    /**
     * Set for verification process?
     *
     * @return  self
     */
    public function setAttempts($attempts)
    {
        $this->attempts = $attempts;

        return $this;
    }
    /**
     * @return boolean
     */
    public function isVerified()
    {
        return empty($this->hash);
    }
    
    /**
     * 
     * @param string $hash
     * @return boolean
     */
    public function verify(string $hash = null)
    {

        if($this->isVerified())
        {
            return true;
        }
        
        $this->attempts++;
        
        if($this->hash != $hash)
        {    
            return false;
        }
        
        $this->hash = null;
            
        return true;
    }
}
