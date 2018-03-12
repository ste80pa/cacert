<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * The domains associated to an Organisation
 *
 * @link http://wiki.cacert.org/Software/Database/StructureDefined#OrgDomains
 * @ORM\Entity(repositoryClass="App\Repository\OrgDomainsRepository")
 */
class OrgDomains
{

    /**
     * @var integer
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", name="domain", length=255)
     */
    private $domain;

    /**
     * @var integer
     * @ORM\Column(type="integer", name="orgid")
     */
    private $orgid;

    /**
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return mixed
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     *
     * @return mixed
     */
    public function getOrgid()
    {
        return $this->orgid;
    }

    /**
     *
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param mixed $domain
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     *
     * @param mixed $orgid
     */
    public function setOrgid($orgid)
    {
        $this->orgid = $orgid;
    }
}
