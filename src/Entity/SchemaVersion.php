<?php
/**
 * Entity derive form
 * http://wiki.cacert.org/Software/Database/StructureDefined
 * @category Other
 * @package  CaCert
 * @author   Stefano Pallozzi <ste80pa@gmail.com>
 * @license  GPL
 * @link
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This table holds the current webdb revision. This table was introduced
 * in Nov 2011 by Software-Assessment project bug #976.
 * Current revision: '1' , November 23, 2011.
 * @category Other
 * @package  CaCert
 * @author   Stefano Pallozzi <ste80pa@gmail.com>
 * @license  GPL
 * @link
 * @ORM\Entity(repositoryClass="App\Repository\SchemaVersionRepository")
 */
class SchemaVersion
{
    /**
     * Id.
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Release date.
     * @ORM\Column(type="integer", nullable=false)
     */
    private $when;

    /**
     * Version number.
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $version;
}
