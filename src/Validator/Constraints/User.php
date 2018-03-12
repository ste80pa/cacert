<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;


/**
 * @Annotation
 */
class User extends Constraint
{

    public $message = 'The value "{{ value }}" is not valid.';
//             "For your own security you must enter 5 different password questions and answers. You aren't allowed to duplicate questions, set questions as answers or use the question as the answer."

    public $weakPasswordMessage = 'The Pass Phrase you submitted failed to contain enough differing characters and/or contained words from your name and/or email address. Only scored {{ value }} points out of 6.';
    
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
