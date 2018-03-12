<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UserValidator extends ConstraintValidator
{
    /**
     * 
     */ 
    private function validatePassword($user, Constraint $constraint)
    {
        $points = 0;
        $pwd = $user->getPassword();

        // check for historical password proposal

        if ($pwd === "Fr3d Sm|7h") {
            return false;
        }
        
        // from old function checkpwlight($pwd)

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
        $lemail  = strtolower($user->getEmail());
        $lfname  = strtolower($user->getFirstName());
        $llname  = strtolower($user->getLastName());
        $lmname  = strtolower($user->getMiddleName());
        $lsuffix = strtolower($user->getNameSuffix());

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

        if($points < 3)
        {
            $this->context->buildViolation($constraint->weakPasswordMessage)
            ->setParameter('{{ points }}', $points)
            ->atPath('password')
            ->addViolation();
        }
    }

    /**
     * 
     */
    private function validateAnswers($user, Constraint $constraint)
    {
        /* Check question 1 */
        if( $user->getQuestion1() == $user->getQuestion2() ||
            $user->getQuestion1() == $user->getQuestion3() ||
            $user->getQuestion1() == $user->getQuestion4() ||
            $user->getQuestion1() == $user->getQuestion5()) {
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->atPath('question1')
            ->addViolation();
        }

        /* Check question 2 */
        if( $user->getQuestion2() == $user->getQuestion3() ||
            $user->getQuestion2() == $user->getQuestion4() ||
            $user->getQuestion2() == $user->getQuestion5()) {
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->atPath('question2')
            ->addViolation();
            }
        
        /* Check question 3 */
        if( $user->getQuestion3() == $user->getQuestion4() ||
            $user->getQuestion3() == $user->getQuestion5() ) {
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->atPath('question3')
            ->addViolation();
        }
        
        /* Check question 4 */
        if( $user->getQuestion4() == $user->getQuestion5() ) {
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->atPath('question4')
            ->addViolation();
        }
            
        /* Check answer 1 */

        if( $user->getAnswer1() == $user->getQuestion1() ||
            $user->getAnswer1() == $user->getQuestion2() ||
            $user->getAnswer1() == $user->getQuestion3() ||
            $user->getAnswer1() == $user->getQuestion4() ||
            $user->getAnswer1() == $user->getQuestion5() ||
            $user->getAnswer1() == $user->getAnswer2() ||
            $user->getAnswer1() == $user->getAnswer3() ||
            $user->getAnswer1() == $user->getAnswer4() ||
            $user->getAnswer1() == $user->getAnswer5()) {
                $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->atPath('answer1')
                ->addViolation();
            }
            /* Check answer 2 */
            if(
            $user->getAnswer2() == $user->getQuestion3() ||
            $user->getAnswer2() == $user->getQuestion4() ||
            $user->getAnswer2() == $user->getQuestion5() ||
            $user->getAnswer2() == $user->getAnswer3() ||
            $user->getAnswer2() == $user->getAnswer4() ||
            $user->getAnswer2() == $user->getAnswer5() )
            {
                $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->atPath('answer2')
                ->addViolation();
            }
            /* Check answer 3 */
            if(
            $user->getAnswer3() == $user->getQuestion4() ||
            $user->getAnswer3() == $user->getQuestion5() ||
            $user->getAnswer3() == $user->getAnswer4() ||
            $user->getAnswer3() == $user->getAnswer5() )
            {
                $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->atPath('answer3')
                ->addViolation();
            }
            /* Check answer 4 */
            if( $user->getAnswer4() == $user->getQuestion5() ||
            $user->getAnswer4() == $user->getAnswer5() )
        {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->atPath('answer4')
                ->addViolation();
        }
    }

    /**
     * 
     */
    public function validate($user, Constraint $constraint)
    {
        /* @var $constraint User */


     

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
