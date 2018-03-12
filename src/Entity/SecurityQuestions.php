<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Embeddable
 */

class SecurityQuestions
{
    
/**
     * Lost Password Question 1
     * @ORM\Column(type="string", name="Q1", length=255)
     */
    private $question1;

    /**
     * Lost Password Answer 1
     * @ORM\Column(type="string", name="A1", length=255)
     */
    private $answer1;

    /**
     * Lost Password Question 2
     * @ORM\Column(type="string", name="Q2", length=255)
     */
    private $question2;

    /**
     * Lost Password Answer 2
     * @ORM\Column(type="string", name="A2", length=255)
     */
    private $answer2;

    /**
     * Lost Password Question 3
     * @ORM\Column(type="string", name="Q3", length=255)
     */
    private $question3;

    /**
     * Lost Password Answer 3
     * @ORM\Column(type="string", name="A3", length=255)
     */
    private $answer3;

    /**
     * Lost Password Question 4
     * @ORM\Column(type="string", name="Q4", length=255)
     */
    private $question4;

    /**
     * Lost Password Answer 4
     * @ORM\Column(type="string", name="A4", length=255)
     */
    private $answer4;

    /**
     * Lost Password Question 5
     * @ORM\Column(type="string", name="Q5", length=255)
     */
    private $question5;

    /**
     * Lost Password Answer 5
     * @ORM\Column(type="string", name="A5", length=255)
     */
    private $answer5;


    /**
     * Get the value of question1
     */
    public function getQuestion1()
    {
        return $this->question1;
    }

    /**
     * Get the value of question2
     */
    public function getQuestion2()
    {
        return $this->question2;
    }

    /**
     * Get lost Password Question 3
     */
    public function getQuestion3()
    {
        return $this->question3;
    }


    /**
     * Get lost Password Question 4
     */ 
    public function getQuestion4()
    {
        return $this->question4;
    }

    /**
     * Get lost Password Question 5
     */ 
    public function getQuestion5()
    {
        return $this->question5;
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
     * Set lost Password Question 3
     *
     * @return  self
     */
    public function setQuestion3($question3)
    {
        $this->question3 = $question3;
        return $this;
    }

    /**
     * @param mixed $question4
     */
    public function setQuestion4($question4)
    {
        $this->question4 = $question4;
    }

    /**
     * @param mixed $question5
     */
    public function setQuestion5($question5)
    {
        $this->question5 = $question5;
    }
    /**
     * Get the value of answer1
     */
    public function getAnswer1()
    {
        return $this->answer1;
    }
/**
     * Get the value of answer2
     */
    public function getAnswer2()
    {
        return $this->answer2;
    }
     /**
     * Get lost Password Answer 3
     */
    public function getAnswer3()
    {
        return $this->answer3;
    }
   /**
     * Get lost Password Answer 4
     */ 
    public function getAnswer4()
    {
        return $this->answer4;
    }
      /**
     * Get lost Password Answer 5
     */ 
    public function getAnswer5()
    {
        return $this->answer5;
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
     * Set lost Password Answer 3
     *
     * @return  self
     */
    public function setAnswer3($answer3)
    {
        $this->answer3 = $answer3;
        return $this;
    }

   
    /**
     * @param mixed $answer4
     */
    public function setAnswer4($answer4)
    {
        $this->answer4 = $answer4;
    }


    /**
     * @param mixed $answer5
     */
    public function setAnswer5($answer5)
    {
        $this->answer5 = $answer5;
    }


 

    /**
     * @Assert\IsTrue(
     * message="For your own security you must enter 5 different password questions and answers. You aren't allowed to duplicate questions, set questions as answers or use the question as the answer."
     * )
     */
    public function isQuestionsAndAnswersValid()
    {
        return true;
        return !(
            /* Check question 1 */
            $this->question1 == $this->question2 ||
            $this->question1 == $this->question3 ||
            $this->question1 == $this->question4 ||
            $this->question1 == $this->question5 ||
            /* Check question 2 */
            $this->question2 == $this->question3 ||
            $this->question2 == $this->question4 ||
            $this->question2 == $this->question5 ||
            /* Check question 3 */
            $this->question3 == $this->question4 ||
            $this->question3 == $this->question5 ||
            /* Check question 4 */
            $this->question4 == $this->question5 ||
            /* Check answer 1 */
            $this->answer1 == $this->question1 ||
            $this->answer1 == $this->question2 ||
            $this->answer1 == $this->question3 ||
            $this->answer1 == $this->question4 ||
            $this->answer1 == $this->question5 ||
            $this->answer1 == $this->answer2 ||
            $this->answer1 == $this->answer3 ||
            $this->answer1 == $this->answer4 ||
            $this->answer1 == $this->answer5 ||
            /* Check answer 2 */
            $this->answer2 == $this->question3 ||
            $this->answer2 == $this->question4 ||
            $this->answer2 == $this->question5 ||
            $this->answer2 == $this->answer3 ||
            $this->answer2 == $this->answer4 ||
            $this->answer2 == $this->answer5 ||
            /* Check answer 3 */
            $this->answer3 == $this->question4 ||
            $this->answer3 == $this->question5 ||
            $this->answer3 == $this->answer4 ||
            $this->answer3 == $this->answer5 ||
            /* Check answer 4 */
            $this->answer4 == $this->question5 ||
            $this->answer4 == $this->answer5
        );
    }


  
}
