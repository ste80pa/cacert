<?php
namespace App\Validator\Constraints;

use App\Validator\SecureEmailValidator;
use Symfony\Component\Validator\Constraint;

/**
 *
 * @Annotation
 */
class SecureEmail extends Constraint
{

    /**
     *
     * @var boolean
     */
    public $allow_punycode = false;

    /**
     *
     * @var string
     */
    public $punycode_message = 'Due to the possibility for punycode domain exploits we currently do not allow any certificates to sign punycode domains or email addresses.';

    /**
     *
     * @var string
     */
    public $exist_message = 'The email address \'{{ value }}\' is already in a different account. Can\'t continue.';

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Validator\Constraint::validatedBy()
     */
    public function validatedBy()
    {
        return SecureEmailValidator::class;
    }
}
