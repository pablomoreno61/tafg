<?php

namespace CSP\Domain\User\Exception;

use Phalcon\Exception;

class UserDoesNotExistsException extends Exception
{
    public function __construct($email = '', $code = 0, Exception $previous = null)
    {
        $message = 'You tried to find a user which does not exists with this e-mail: ' . $email;

        parent::__construct($message, $code, $previous);
    }
}
