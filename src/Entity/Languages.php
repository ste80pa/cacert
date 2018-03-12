<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguagesRepository")
 */
class Languages
{
    /**
     *  i.e. en_US, de_AT, de_CH
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $locale;
   
    /**
     * i.e. Austria, Germany, Switzerland
     * @ORM\Column(type="string")
     */
    private $en_co;
  
    /**
     * i.e. German, Danish, German
     * @ORM\Column(type="string")
     */
    private $en_lang;
    /**
     * i.e. Österreich, Danmark, Schweiz
     * @ORM\Column(type="string")
     */
    private $country;
    /**
     * i.e. Deutsch, dansk, Deutsch
     * @ORM\Column(type="string")
     */
    private $lang;
    
    public function __toString()
    {
        return "[$this->locale] {$this->lang} ({$this->en_co})";
    }
}
