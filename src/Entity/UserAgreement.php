<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserAgreementRepository")
 */
class UserAgreement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Member for which the agreement is recorded
     * @ORM\Column(type="integer", name="memid")
     */
    private $memberId;

    /**
     * User that is involved in the agreement (e.g. Assurer) / ID of another member involved,
     * like the counterpart in an Assurance
     * @ORM\Column(type="integer", name="secmemid")
     */
    private $secmemid;

    /**
     * Kind of agreement which got accepted, e.g. "CCA"
     * @ORM\Column(type="string", name="document", length=50)
     */
    private $document;
    /**
     * Time the agreement was recorded
     * @ORM\Column(type="date", name="date")
     */
    private $date;

    /**
     * Whether the user actively agreed or if the agreement took place via an indirect process (e.g. Assurance)
     * @ORM\Column(type="integer", name="active", length=1)
     */
    private $active;

    /**
     * In which process did the agreement take place (e.g. certificate issuance, account creation, assurance)
     * @ORM\Column(type="string", name="method", length=100)
     */
    private $method;

    /**
     * User comment, Describes the circumstances, currently one of "Assuring", "Being assured", "GPG",
     *  "called from ...", depending on which action the user wanted to do when accepting the agreement.
     * @ORM\Column(type="string", name="comment", length=100)
     */
    private $comment;
}
