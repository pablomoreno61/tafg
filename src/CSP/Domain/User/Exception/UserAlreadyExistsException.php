<?php

namespace CSP\Domain\User\Exception;

use CSP\Domain\User\Entity\User;
use Phalcon\Exception;

class UserAlreadyExistsException extends Exception
{
    public function __construct(User $user, $code = 0, Exception $previous = null)
    {
        $message = "The user {$user->getEmail()} is already registered";

        parent::__construct($message, $code, $previous);
    }
}
