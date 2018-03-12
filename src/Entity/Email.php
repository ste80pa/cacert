<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @link http://wiki.cacert.org/Software/Database/StructureDefined#Email
 * Contains a list of all mail adresses (including the primary one named in the Users table)
 *  associated to user accounts.
 * @ORM\Entity(repositoryClass="App\Repository\EmailRepository")
 */
class Email
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Foreign key to table Users, associated account.
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="emails")
     * @ORM\JoinColumn(name="memid", nullable=true)
     */
    private $user;

    /**
     * @ORM\Column(type="string", name="email", length=255)
     */
    private $email;


    /**
     * @ORM\Column(type="datetime", name="created",  nullable=true, options={"default"="CURRENT_TIMESTAMP"} )
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
     * If a new mail address is added the verification hash is stored here until the mail address has been verified.
     * So email.hash = ' ' is a restriction that finds only verified mails.
     * @ORM\Column(type="string", name="hash", length=50)
     */
    private $hash;

    /**
     * For verification process?
     * @ORM\Column(type="integer", name="attempts", length=1, options={"default":0})
     */
    private $attempts = 0;

  
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set the value of created
     *
     * @return  self
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get the value of modified
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set the value of modified
     *
     * @return  self
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get timestamp of deletion, is set if the user deletes the mail address from his/her account.
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set timestamp of deletion, is set if the user deletes the mail address from his/her account.
     *
     * @return  self
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get if a new mail address is added the verification hash is stored here until the mail address has been verified.
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set if a new mail address is added the verification hash is stored here until the mail address has been verified.
     *
     * @return  self
     */
    public function setHash($hash)
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
}
