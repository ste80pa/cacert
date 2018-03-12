<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddLangRepository")
 */
class AddLang
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * A User, who selected a secondary language
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="languages")
     * @ORM\JoinColumn(name="userid", nullable=true)
     */
    private $user;

    /**
     * Language code, relates to table Languages locale, i.e. en_US, de_AT
     * @ORM\ManyToOne(targetEntity="App\Entity\Languages")
     * @ORM\JoinColumn(name="lang", referencedColumnName="locale", nullable=true)
     */
    private $lang;

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
     * Get a User, who selected a secondary language
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set a User, who selected a secondary language
     *
     * @return  self
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of lang
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set the value of lang
     *
     * @return  self
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }
}
