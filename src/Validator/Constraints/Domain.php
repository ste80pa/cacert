<?php
namespace App\Validator\Constraints;

use App\Validator\DomainValidator;
use Symfony\Component\Validator\Constraint;

/**
 *
 * @Annotation
 */
class Domain extends Constraint
{

    /**
     *
     * @var boolean
     */
    public $allow_null_bytes_domain = false;

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
    public $null_bytes_message = 'Due to the possibility for nullbyte domain exploits we currently do not allow any domain names with nullbytes.';

    /**
     *
     * @var string
     */
    public $exist_message = 'The domain \'{{ value }}\' is already in a different account and is listed as valid. Can\'t continue.';

    /**
     *
     * {@inheritdoc}
     * @see \Symfony\Component\Validator\Constraint::validatedBy()
     */
    public function validatedBy()
    {
        return DomainValidator::class;
    }
}
