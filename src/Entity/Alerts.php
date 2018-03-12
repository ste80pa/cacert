<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlertsRepository")
 */
class Alerts
{
 //  ORM\JoinColumn(type="integer", name="memid", options={"dafault":0})
 // ORM\OneToOne(targetEntity="User", mappedBy="alerts", cascade={"ALL"})
 // ORM\JoinColumn(name="memid",referencedColumnName="id")
 // ORM\Column(type="integer", name="memid", options={"dafault":0})

  /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="alerts")
     * @ORM\JoinColumn(name="memid", nullable=true)
    */
    private $user;

    /**
    * @ORM\Column(type="boolean", name="general", options={"dafault":0})
    */
    private $general;

    /**
    * @ORM\Column(type="boolean", name="country", options={"dafault":0})
    */
    private $country;

    /**
    * @ORM\Column(type="boolean", name="regional", options={"dafault":0})
    */
    private $regional;

    /**
    * @ORM\Column(type="boolean", name="radius", options={"dafault":0})
    */
    private $radius;
    
    /**
     * Get the value of user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of memid
     * @param User $user
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of radius
     */
    public function getRadius()
    {
        return $this->radius;
    }

    /**
     * Set the value of radius
     *
     * @return  self
     */
    public function setRadius($radius)
    {
        $this->radius = $radius;

        return $this;
    }

    /**
     * Get the value of regional
     */
    public function getRegional()
    {
        return $this->regional;
    }

    /**
     * Set the value of regional
     *
     * @return  self
     */
    public function setRegional($regional)
    {
        $this->regional = $regional;

        return $this;
    }

    /**
     * Get the value of general
     */
    public function getGeneral()
    {
        return $this->general;
    }

    /**
     * Set the value of general
     *
     * @return  self
     */
    public function setGeneral($general)
    {
        $this->general = $general;

        return $this;
    }

    /**
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

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
}
