<?php

namespace CSP\Domain\Finance\Exception;

use CSP\Domain\Finance\Entity\Reward;
use Phalcon\Exception;

class RewardAlreadyExistsException extends Exception
{
    public function __construct(Reward $reward, $code = 0, Exception $previous = null)
    {
        $message = "The reward {$reward->getName()}/{$reward->getUser()->getId()} is already registered";

        parent::__construct($message, $code, $previous);
    }
}
