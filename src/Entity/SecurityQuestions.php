<?php
namespace App\Entity;

use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @ORM\Embeddable
 */
class SecurityQuestions
{

    /**
     * Lost Password Question 1
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     * @ORM\Column(type="string", name="Q1", length=255)
     */
    private $question1;

    /**
     * Lost Password Answer 1
     *
     * @Assert\NotBlank()
     * @ORM\Column(type="string", name="A1", length=255)
     */
    private $answer1;

    /**
     * Lost Password Question 2
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     * @ORM\Column(type="string", name="Q2", length=255)
     */
    private $question2;

    /**
     * Lost Password Answer 2
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     * @ORM\Column(type="string", name="A2", length=255)
     */
    private $answer2;

    /**
     * Lost Password Question 3
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     * @ORM\Column(type="string", name="Q3", length=255)
     */
    private $question3;

    /**
     * Lost Password Answer 3
     *
     * @Assert\Length(max = 255)
     * @ORM\Column(type="string", name="A3", length=255)
     */
    private $answer3;

    /**
     * Lost Password Question 4
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     * @ORM\Column(type="string", name="Q4", length=255)
     */
    private $question4;

    /**
     * Lost Password Answer 4
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     * @ORM\Column(type="string", name="A4", length=255)
     */
    private $answer4;

    /**
     * Lost Password Question 5
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
     * @ORM\Column(type="string", name="Q5", length=255)
     */
    private $question5;

    /**
     * Lost Password Answer 5
     *
     * @Assert\NotBlank()
     * @Assert\Length(max = 255)
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
     * @return self
     */
    public function setQuestion1($question1)
    {
        $this->question1 = $question1;
        return $this;
    }

    /**
     * Set the value of question2
     *
     * @return self
     */
    public function setQuestion2($question2)
    {
        $this->question2 = $question2;
        return $this;
    }

    /**
     * Set lost Password Question 3
     *
     * @return self
     */
    public function setQuestion3($question3)
    {
        $this->question3 = $question3;
        return $this;
    }

    /**
     *
     * @param mixed $question4
     */
    public function setQuestion4($question4)
    {
        $this->question4 = $question4;
    }

    /**
     *
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
     * @return self
     */
    public function setAnswer1($answer1)
    {
        $this->answer1 = $answer1;
        return $this;
    }

    /**
     * Set the value of answer2
     *
     * @return self
     */
    public function setAnswer2($answer2)
    {
        $this->answer2 = $answer2;
        return $this;
    }

    /**
     * Set lost Password Answer 3
     *
     * @return self
     */
    public function setAnswer3($answer3)
    {
        $this->answer3 = $answer3;
        return $this;
    }

    /**
     *
     * @param mixed $answer4
     */
    public function setAnswer4($answer4)
    {
        $this->answer4 = $answer4;
    }

    /**
     *
     * @param mixed $answer5
     */
    public function setAnswer5($answer5)
    {
        $this->answer5 = $answer5;
    }

    /**
     *
     * @Assert\Callback
     *
     * @param ExecutionContextInterface $context
     * @param mixed $payload
     */
    public function validate(ExecutionContextInterface $context, $payload)
    {
        $q = [];
        $a = [];

        for ($i = 1; $i < 6; $i ++) {
            $q[$i] = [
                'qc' => 0,
                'ac' => 0,
                'q' => [],
                'a' => []
            ];

            $a[$i] = [
                'qc' => 0,
                'ac' => 0,
                'q' => [],
                'a' => []
            ];
        }

        /*
         * Check
         * - questions against answers
         * - questions against questions
         * - answers against answers
         */
        for ($i = 1; $i < 6; $i ++) {

            $answer = $this->{"answer{$i}"};
            $question = $this->{"question{$i}"};

            for ($j = 1; $j < 6; $j ++) {
                if ($this->{"question{$j}"} == $answer) {
                    $q[$j]['a'][] = $i;
                    $a[$i]['q'][] = $j;
                    $q[$j]['ac'] += 1;
                    $a[$i]['qc'] += 1;
                }

                if ($i == $j) {
                    continue;
                }

                if ($this->{"question{$j}"} == $question) {
                    $q[$i]['q'][] = $j;
                    $q[$i]['qc'] += 1;
                }

                if ($this->{"answer{$j}"} == $answer) {
                    $a[$i]['a'][] = $j;
                    $a[$i]['ac'] += 1;
                }
            }
        }

        /* Check and add violations */

        for ($i = 1; $i < 6; $i ++) {

            $qqc = $q[$i]['qc'];
            $qac = $q[$i]['ac'];
            $aqc = $a[$i]['qc'];
            $aac = $a[$i]['ac'];

            if ($qqc || $qac) {

                if ($qqc == 0) {
                    $context->buildViolation('Question {{ question }} is equal to answers {{ answers }}')
                        ->setParameter('{{ question }}', $i)
                        ->setParameter('{{ answers }}', join(',', $q[$i]['a']))
                        ->atPath("question{$i}")
                        ->addViolation();
                } elseif ($qac == 0) {
                    $context->buildViolation('Question {{ question }} is equal to questions {{ questions }}')
                        ->setParameter('{{ question }}', $i)
                        ->setParameter('{{ questions }}', join(',', $q[$i]['q']))
                        ->atPath("question{$i}")
                        ->addViolation();
                } else {
                    $context->buildViolation(
                        'Question {{ question }} is equal to answers {{ answers }} and to questions {{ questions }}')
                        ->setParameter('{{ question }}', $i)
                        ->setParameter('{{ answers }}', join(',', $q[$i]['a']))
                        ->setParameter('{{ questions }}', join(',', $q[$i]['q']))
                        ->atPath("question{$i}")
                        ->addViolation();
                }
            }

            if ($aqc || $aac) {

                if ($aqc == 0) {
                    $context->buildViolation('Answer {{ answer }} is equal to answers {{ answers }}')
                        ->setParameter('{{ answer }}', $i)
                        ->setParameter('{{ answers }}', join(',', $a[$i]['a']))
                        ->atPath("answer{$i}")
                        ->addViolation();
                } elseif ($aac == 0) {
                    $context->buildViolation('Answer {{ answer }} is equal to questions {{ questions }}')
                        ->setParameter('{{ answer }}', $i)
                        ->setParameter('{{ questions }}', join(',', $a[$i]['q']))
                        ->atPath("answer{$i}")
                        ->addViolation();
                } else {
                    $context->buildViolation(
                        'Answer {{ answer }} is equal to answers {{ answers }} and to questions {{ questions }}')
                        ->setParameter('{{ answer }}', $i)
                        ->setParameter('{{ answers }}', join(',', $a[$i]['a']))
                        ->setParameter('{{ questions }}', join(',', $a[$i]['q']))
                        ->atPath("answer{$i}")
                        ->addViolation();
                }
            }
        }
    }
}
