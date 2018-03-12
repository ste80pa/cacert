<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 */
class RegistrationInfo
{
    /**
     * @Assert\NotBlank()
     */
    protected $firstName;
    /**
     *
     */
    protected $middleName;
    /**
     * @Assert\NotBlank()
     */
    protected $lastName;
    /**
     *
     */
    protected $nameSuffix;
    /**
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $birthDate;
    /**
     *
     * @Assert\NotBlank()
     */
    protected $passPhrase;
    /**
     *
     */
    protected $repeatedPassPhrase;
    /**
     *
     */
    protected $email;
    /**
     *
     */
    protected $question1;
    /**
     *
     */
    protected $answer1;
    /**
     *
     */
    protected $question2;
    /**
     *
     */
    protected $answer2;
    /**
     *
     */
    protected $question3;
    /**
     *
     */
    protected $answer3;
    /**
     *
     */
    protected $question4;
    /**
     *
     */
    protected $answer4;
    /**
     *
     */
    protected $question5;
    /**
     *
     */
    protected $answer5;
    /**
     *
     */
    protected $agreement;

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
     * Get the value of middleName
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set the value of middleName
     *
     * @return  self
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get the value of lastName
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of agreement
     */
    public function getAgreement()
    {
        return $this->agreement;
    }

    /**
     * Set the value of agreement
     *
     * @return  self
     */
    public function setAgreement($agreement)
    {
        $this->agreement = $agreement;

        return $this;
    }

    /**
     * Get the value of answer5
     */
    public function getAnswer5()
    {
        return $this->answer5;
    }

    /**
     * Set the value of answer5
     *
     * @return  self
     */
    public function setAnswer5($answer5)
    {
        $this->answer5 = $answer5;

        return $this;
    }

    /**
     * Get the value of answer4
     */
    public function getAnswer4()
    {
        return $this->answer4;
    }

    /**
     * Set the value of answer4
     *
     * @return  self
     */
    public function setAnswer4($answer4)
    {
        $this->answer4 = $answer4;

        return $this;
    }

    /**
     * Get the value of question4
     */
    public function getQuestion4()
    {
        return $this->question4;
    }

    /**
     * Set the value of question4
     *
     * @return  self
     */
    public function setQuestion4($question4)
    {
        $this->question4 = $question4;

        return $this;
    }

    /**
     * Get the value of birthDate
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @return  self
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get the value of passPhrase
     */
    public function getPassPhrase()
    {
        return $this->passPhrase;
    }

    /**
     * Set the value of passPhrase
     *
     * @return  self
     */
    public function setPassPhrase($passPhrase)
    {
        $this->passPhrase = $passPhrase;

        return $this;
    }

    /**
     * Get the value of repeatedPassPhrase
     */
    public function getRepeatedPassPhrase()
    {
        return $this->repeatedPassPhrase;
    }

    /**
     * Set the value of repeatedPassPhrase
     *
     * @return  self
     */
    public function setRepeatedPassPhrase($repeatedPassPhrase)
    {
        $this->repeatedPassPhrase = $repeatedPassPhrase;

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
     * Get the value of question1
     */
    public function getQuestion1()
    {
        return $this->question1;
    }

    /**
     * Set the value of question1
     *
     * @return  self
     */
    public function setQuestion1($question1)
    {
        $this->question1 = $question1;

        return $this;
    }

    /**
     * Get the value of answer1
     */
    public function getAnswer1()
    {
        return $this->answer1;
    }

    /**
     * Set the value of answer1
     *
     * @return  self
     */
    public function setAnswer1($answer1)
    {
        $this->answer1 = $answer1;

        return $this;
    }

    /**
     * Get the value of nameSuffix
     */
    public function getNameSuffix()
    {
        return $this->nameSuffix;
    }

    /**
     * Set the value of nameSuffix
     *
     * @return  self
     */
    public function setNameSuffix($nameSuffix)
    {
        $this->nameSuffix = $nameSuffix;

        return $this;
    }

    /**
     * Get the value of question2
     */
    public function getQuestion2()
    {
        return $this->question2;
    }

    /**
     * Set the value of question2
     *
     * @return  self
     */
    public function setQuestion2($question2)
    {
        $this->question2 = $question2;

        return $this;
    }

    /**
     * Get the value of question3
     */
    public function getQuestion3()
    {
        return $this->question3;
    }

    /**
     * Set the value of question3
     *
     * @return  self
     */
    public function setQuestion3($question3)
    {
        $this->question3 = $question3;

        return $this;
    }

    /**
     * Get the value of question5
     */
    public function getQuestion5()
    {
        return $this->question5;
    }

    /**
     * Get the value of answer2
     */
    public function getAnswer2()
    {
        return $this->answer2;
    }

    /**
     * Set the value of answer2
     *
     * @return  self
     */
    public function setAnswer2($answer2)
    {
        $this->answer2 = $answer2;

        return $this;
    }

    /**
     * Get the value of answer3
     */
    public function getAnswer3()
    {
        return $this->answer3;
    }

    /**
     * Set the value of answer3
     *
     * @return  self
     */
    public function setAnswer3($answer3)
    {
        $this->answer3 = $answer3;

        return $this;
    }
}
