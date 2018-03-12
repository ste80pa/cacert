<?php

namespace App\Utils;

class Exception extends \Exception
{
    const UNKNOWN_EXCEPTION = 0x00;
    const NULL_BYTES_DOMAIN = 0x10;
    const PUNYCODE_NOT_ALLOWED = 0x11;
    
    protected static $messages = [
        self::NULL_BYTES_DOMAIN => 'Due to the possibility for nullbyte domain exploits we currently do not allow any domain names with nullbytes.',
        self::PUNYCODE_NOT_ALLOWED => 'Due to the possibility for punycode domain exploits we currently do not allow any certificates to sign punycode domains or email addresses.',
        self::UNKNOWN_EXCEPTION => 'Unknown exception'
    ];

    public function __construct($message = null, $code = 0, \Exception $previous = null) {

        $exceptionMessage = $message;
        $exceptionCode    = $code;

        if ($message === null) {
            if (array_key_exists($code, self::$messages)) {
                $exceptionMessage = self::$messages[$code];
            } else {
                $exceptionMessage = self::$messages[self::UNKNOWN_EXCEPTION];
                $exceptionCode    = self::UNKNOWN_EXCEPTION;
            }
        }

        parent::__construct($message, $code, $previous);
    }
}