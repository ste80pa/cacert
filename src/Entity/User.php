<?php
/**
 * @author Stefano Pallozzi <ste80pa@gmail.com>
 * @link http://symfony.com/doc/current/security/entity_provider.html
 * @link http://wiki.cacert.org/Software/Database/StructureDefined#User_Data
 */
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Contains one record for each registered user.
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * This is the "SSO-ID" which is included in client certificates if the "Add Single Sign On ID Information"
     * button is selected during certificate creation.
     * This ID is calculated during account creation as a hash of the creation time
     * and 64 byes of random. It is not guaranteed to be unique, but de facto collisions are extremly improbable.
     * @ORM\Column(type="string", name="uniqueID", length=255, nullable=false, unique=true)
     */
    private $uniqueID;

    /**
     * Primary email address of the account.
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = false,
     *     checkHost = false
     * )
     * @ORM\Column(type="string", name="email", length=255, nullable=false, unique=true)
     */
    private $email;

    /**
     * Encrypted password.
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="password", length=255, nullable=false)
     */
    private $password;

    /**
     * Repeated password.
     * Assert\NotBlank()
     */
    private $repeatedPassPhrase;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="fname", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", name="mname", nullable=true, length=255)
     */
    private $middleName;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="lname", length=255)
     */
    private $lastName;

    /**
     * Name suffix
     * @ORM\Column(type="string", name="suffix", nullable=true,length=50)
     */
    private $nameSuffix;

    /**
     * Date of Birth
     * @ORM\Column(type="datetime", name="dob")
     */
    private $dateOfBirth;

    /**
     * 1 if probe mail answered
     * @ORM\Column(type="boolean", name="verified", options={"dafault":false})
     */
    private $verified = false;

    /**
     * country: pointer to countries.id
     * @ORM\Column(type="integer", name="ccid", length=3, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="integer", name="regid", length=5, nullable=true )
     */
    private $region;

    /**
     * @ORM\Column(type="integer", name="locid", length=7, nullable=true)
     */
    private $location;

    /**
     * 1 if published in Assurer List
     * @ORM\Column(type="boolean", name="listme",options={"default": false})
     */
    private $listMe = false;

    /**
     * Contact info.
     * @ORM\Column(type="string", name="contactinfo", nullable=true, length=255)
     */
    private $contactinfo;

    /**
     * 1 if allowed to request code signing certs
     * @ORM\Column(type="boolean", name="codesign", options={"default": false})
     */
    private $codesign = false;

    /**
     * 1 if user is admin
     * @ORM\Column(type="boolean", name="admin", options={"default": false})
     */
    private $admin = false;

    /**
     *  @ORM\Column(type="boolean", name="locked", options={"default": false})
     */
    private $locked = false;
    /**
     * 1 if user is TTP admin, it allows to set the Assurance Method to
     * "Trusted 3rd Parties" and leave some of those checkboxes on the Assurance
     * page unchecked.
     * It does not allow to issue more than the usual maximum points
     * @ORM\Column(type="boolean", name="ttpadmin", options={"default": false})
     */
    private $ttpAdmin = false;

    /**
     * 1 if user is Org admin
     * @ORM\Column(type="boolean", name="orgadmin", options={"default": false})
     */
    private $orgAdmin = false;

    /**
     * 1 if user has additional privileged of CAcert's board.
     * In addition with ttpadmin allows to set all Assurance methods :
     * "Face to Face Meeting",
     * "Trusted 3rd Parties",
     * "Thawte Points Transfer",
     * "Administrative Increase",
     * "CT Magazine - Germany".
     * Allows issuance of temporary increases if a sponsor (another user with board-flag set) is named.
     * @ORM\Column(type="boolean", name="board",options={"default": false})
     */
    private $board = false;

    /**
     * 1 if user is tverify admin.
     * @ORM\Column(type="boolean", name="tverify", options={"default": false})
     */
    private $tverify = false;

    /**
     * 1 if user can administer the location database
     * @ORM\Column(type="boolean", name="locadmin", options={"default": false})
     */
    private $locAdmin = false;

    /**
     * Preferred language.
     * @ORM\Column(type="string", name="language", length=5)
     */
    private $language = 'en_US';

    /**
     * Something with OneTimePassword.
     * @ORM\Column(type="smallint", name="otppin", length=4, nullable=true)
     */
    private $otppin;

    /**
     * @ORM\Column(type="string", name="orphash", length=16, nullable=true)
     */
    private $orphash;

    /**
     * 0 = none, 1 = submit, 2 = approve
     * @ORM\Column(type="integer", name="adadmin", options={"default": 0})
     */
    private $adadmin = 0;

    /**
     * 1 if user is Assurer (100 Assurance Points plus Challenge).
     * This field is caching only.
     * If performance does not forbid try to select the underlying data instead.
     * @ORM\Column(type="integer", name="assurer", length=2 , options={"default": 0})
     */
    private $assurer  = 0;

    /**
     * 1 if user may not become assurer
     * @ORM\Column(type="boolean", name="assurer_blocked", options={"default": false})
     */
    private $assurerBlocked = false;

    /**
     * When the last failed login attempt for this user was.
     * @ORM\Column(type="datetime", name="lastLoginAttempt", nullable=true)
     */
    private $lastLoginAttempt;

    /**
     * Timestamp of account creation.
     * @ORM\Column(type="datetime", name="created", nullable=true, options={"default"="CURRENT_TIMESTAMP"} )
     */
    private $created;

    /**
     * Timestamp of last account modification.
     * @ORM\Column(type="datetime", name="modified", nullable=true)
     */
    private $modified;

    /**
     * Timestamp of account deletion, is set when the account is "deleted" from the support interface.
     * @ORM\Column(type="datetime", name="deleted", nullable=true)
     */
    private $deleted;

    /**
     * @Assert\Type(type="App\Entity\Alerts")
     * @ORM\OneToOne(targetEntity="App\Entity\Alerts", mappedBy="user", cascade={"ALL"})
     */
    private $alerts;

    /**
    * @ORM\OneToMany(targetEntity="App\Entity\Email", mappedBy="user")
    * @ORM\OrderBy({"email" = "ASC"})
    */
    private $emails;

    /**
     * @ORM\Embedded(class = "SecurityQuestions", columnPrefix = false)
     */
    private $securityQuestions;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AddLang", mappedBy="user", cascade={"ALL"}, orphanRemoval=true)
     */
    private $languages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Domains", mappedBy="user")
     * @ORM\OrderBy({"domain" = "ASC"})
     */
    private $domains;

    /**
     * @return mixed
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * @param mixed $domains
     */
    public function setDomains($domains)
    {
        $this->domains = $domains;
    }

    public function __construct()
    {
        $this->securityQuestions = new SecurityQuestions();
        $this->languages = new ArrayCollection();
        $this->emails = new ArrayCollection();
        $this->domains = new ArrayCollection();
    }

    /**
     *
     */
    public function getRepeatedPassPhrase()
    {
        return $this->repeatedPassPhrase;
    }

    /**
     *
     */
    public function setRepeatedPassPhrase($repeatedPassPhrase)
    {
        $this->repeatedPassPhrase = $repeatedPassPhrase;
        return $this;
    }

    /**
     *
     */
    public function getAgreement()
    {

    
    }

    /**
     *
     */
    public function setAgreement($pass)
    {
            
    }

    /**
     * @return mixed
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getNameSuffix()
    {
        return $this->nameSuffix;
    }

    /**
     * @return mixed
     */
    public function getContactinfo()
    {
        return $this->contactinfo;
    }

    /**
     * @return mixed
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @return mixed
     */
    public function getVerified()
    {
        return $this->verified;
    }

    /**
     * @return mixed
     */
    public function getListMe()
    {
        return $this->listMe;
    }

    /**
     * @return boolean
     */
    public function getCodesign()
    {
        return $this->codesign;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @return mixed
     */
    public function getTtpAdmin()
    {
        return $this->ttpAdmin;
    }

    /**
     * @return mixed
     */
    public function getOrgAdmin()
    {
        return $this->orgAdmin;
    }

    /**
     * @return mixed
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * @return mixed
     */
    public function getTverify()
    {
        return $this->tverify;
    }

    /**
     * @return mixed
     */
    public function getLocAdmin()
    {
        return $this->locAdmin;
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return mixed
     */
    public function getOtppin()
    {
        return $this->otppin;
    }

    /**
     * @return mixed
     */
    public function getOrphash()
    {
        return $this->orphash;
    }

    /**
     * @return mixed
     */
    public function getAdadmin()
    {
        return $this->adadmin;
    }

    /**
     * @return mixed
     */
    public function getAssurer()
    {
        return $this->assurer;
    }

    /**
     * @return mixed
     */
    public function getAssurerBlocked()
    {
        return $this->assurerBlocked;
    }

    /**
     * @return mixed
     */
    public function getLastLoginAttempt()
    {
        return $this->lastLoginAttempt;
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
     * @param mixed $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @param mixed $nameSuffix
     */
    public function setNameSuffix($nameSuffix)
    {
        $this->nameSuffix = $nameSuffix;
    }

    /**
     * @param mixed $contactinfo
     */
    public function setContactinfo($contactinfo)
    {
        $this->contactinfo = $contactinfo;
    }

    /**
     * @param mixed $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * @param mixed $verified
     */
    public function setVerified($verified)
    {
        $this->verified = $verified;
    }

    /**
     * @param mixed $listMe
     */
    public function setListMe($listMe)
    {
        $this->listMe = $listMe;
    }

    /**
     * @param mixed $codesign
     */
    public function setCodesign($codesign)
    {
        $this->codesign = $codesign;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

    /**
     * @param mixed $ttpAdmin
     */
    public function setTtpAdmin($ttpAdmin)
    {
        $this->ttpAdmin = $ttpAdmin;
    }

    /**
     * @param mixed $orgAdmin
     */
    public function setOrgAdmin($orgAdmin)
    {
        $this->orgAdmin = $orgAdmin;
    }

    /**
     * @param mixed $board
     */
    public function setBoard($board)
    {
        $this->board = $board;
    }

    /**
     * @param mixed $tverify
     */
    public function setTverify($tverify)
    {
        $this->tverify = $tverify;
    }

    /**
     * @param mixed $locAdmin
     */
    public function setLocAdmin($locAdmin)
    {
        $this->locAdmin = $locAdmin;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @param mixed $otppin
     */
    public function setOtppin($otppin)
    {
        $this->otppin = $otppin;
    }

    /**
     * @param mixed $orphash
     */
    public function setOrphash($orphash)
    {
        $this->orphash = $orphash;
    }

    /**
     * @param mixed $adadmin
     */
    public function setAdadmin($adadmin)
    {
        $this->adadmin = $adadmin;
    }

    /**
     * @param mixed $assurer
     */
    public function setAssurer($assurer)
    {
        $this->assurer = $assurer;
    }

    /**
     * @param mixed $assurerBlocked
     */
    public function setAssurerBlocked($assurerBlocked)
    {
        $this->assurerBlocked = $assurerBlocked;
    }

    /**
     * @param mixed $lastLoginAttempt
     */
    public function setLastLoginAttempt($lastLoginAttempt)
    {
        $this->lastLoginAttempt = $lastLoginAttempt;
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
     * @Assert\IsTrue(message="The password cannot match your first name")
     */
    public function isPasswordValid()
    {
        // check for historical password proposal

        if ($this->password === "Fr3d Sm|7h") {
            return false;
        }
        
        // from old function checkpwlight($pwd)

        $points = 0;
        $pwd = $this->password;

        $l = strlen($pwd);

        if ($l > 15) {
            $points++;
        }

        if ($l > 20) {
            $points++;
        }
        
        if ($l > 25) {
            $points++;
        }
                
        if ($l > 30) {
            $points++;
        }

        if (preg_match("/\d/", $pwd)) {
            $points++;
        }
    
        if (preg_match("/[a-z]/", $pwd)) {
            $points++;
        }
    
        if (preg_match("/[A-Z]/", $pwd)) {
            $points++;
        }
        
        if (preg_match("/\W/", $pwd)) {
            $points++;
        }
        
        if (preg_match("/\s/", $pwd)) {
            $points++;
        }

        $lpwd    = strtolower($pwd);
        $lemail  = strtolower($this->email);
        $lfname  = strtolower($this->firstName);
        $llname  = strtolower($this->lastName);
        $lmname  = strtolower($this->middleName);
        $lsuffix = strtolower($this->nameSuffix);

        if (strstr($lpwd, $lemail) !== false) {
            $points--;
        }

        if (strstr($lpwd, $lfname)!== false) {
            $points--;
        }
       
        if (strstr($lpwd, $llname)!== false) {
            $points--;
        }

        if (strstr($lemail, $lpwd) !== false) {
            $points--;
        }

        if (strstr($llname, $lpwd) !== false) {
            $points--;
        }

        if (strstr($lfname, $lpwd) !== false) {
            $points--;
        }

        if (!empty($lmname)) {
            if (strstr($lpwd, $lmname)!==false) {
                $points--;
            }
            if (strstr($lmname, $lpwd)!==false) {
                $points--;
            }
        }

        if (!empty($lsuffix)) {
            if (strstr($lpwd, $lsuffix)!==false) {
                $points--;
            }

            if (strstr($lsuffix, $lpwd)!== false) {
                $points--;
            }
        }

        $shellpwd = escapeshellarg($lpwd);
        $do = shell_exec("grep -F -- $shellpwd /usr/share/dict/american-english");
        
        if ($do) {
            $points--;
        }

        return true;
    }
    
    /**
     *
     */
    public function getUsername()
    {
        return $this->email;
    }
    /**
     *
     */
    public function getSalt()
    {
        return null;
    }

   /**
    *
    * @return string
    */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     *
     * @return string[]
     */
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }

    /**
     *
     */
    public function eraseCredentials()
    {
    }

    /**
     *
     * @return boolean
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     *
     * @return boolean
     */
    public function isAccountNonLocked()
    {
        return !$this->locked;
    }
    /**
     *
     * @return boolean
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     *
     * @return boolean
     */
    public function isEnabled()
    {
        return $this->isAccountNonLocked();
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->email,
            $this->password
        ]);
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->email,
            $this->password,
          
        ) = unserialize($serialized);
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

   /**
    *
    * @return string
    */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the value of firstName
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get country: pointer to countries.id
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country: pointer to countries.id
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get the value of region
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set the value of region
     *
     * @return  self
     */
    public function setRegion($region)
    {
        $this->region = $region;
        return $this;
    }

    /**
     * Get the value of location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set the value of location
     *
     * @return  self
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Get the value of uniqueID
     */
    public function getUniqueID()
    {
        return $this->uniqueID;
    }

    /**
     * Set the value of uniqueID
     *
     * @return  self
     */
    public function setUniqueID($uniqueID)
    {
        $this->uniqueID = $uniqueID;
        return $this;
    }

    /**
     * Get the value of alerts
     */
    public function getAlerts()
    {
        return $this->alerts;
    }

    /**
     * Set the value of alerts
     *
     * @return  self
     */
    public function setAlerts($alerts)
    {
        $alerts->setUser($this);
        $this->alerts = $alerts;
        return $this;
    }

    /**
     * Get emails
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set emails
     *
     * @return  self
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Get the value of locked
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * Set the value of locked
     *
     * @return  self
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }


     /**
     * Get the value of languages
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     *
     */
    public function addLanguage($language)
    {
        $language->setUser($this);
        $this->languages->add($language);
    }

    /**
     *
     */
    public function removeLanguage($language)
    {
       // $language->setUser(null);
        $this->languages->removeElement($language);
    }

    /**
     * Set the value of languages
     *
     * @return  self
     */ 
    public function setLanguages($languages)
    {
        $this->languages = $languages;

        foreach ($this->languages->getIterator() as $item) {
            $item->setUser($this);
        }
        
        return $this;
    }

    /**
     * 
     */
    public function getQuestions()
    {
        return $this->securityQuestions;

    }

    public function setQuestions(SecurityQuestions $securityQuestions)
    {
        $this->securityQuestions = $securityQuestions;
        return $this;
    }
    /**
     * @link https://en.gravatar.com/site/implement/images/
     * Returns the gravatar avatar
     * @param $size
     * @param $default 
     * @return string
     */
    public function getGravatarUrl($size = 48, $default = 'mm')
    {
        return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?s=' .  $size . '&d=' . $default;
    }
}
