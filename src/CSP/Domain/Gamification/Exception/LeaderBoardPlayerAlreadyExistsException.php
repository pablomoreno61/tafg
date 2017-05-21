<?php

namespace CSP\Domain\Finance\Exception;

use CSP\Domain\Gamification\Entity\LeaderBoardPlayer;
use Phalcon\Exception;

class LeaderBoardPlayerAlreadyExistsException extends Exception
{
    public function __construct(LeaderBoardPlayer $leaderBoardPlayer, $code = 0, Exception $previous = null)
    {
        $message = "The player {$leaderBoardPlayer->getUser()->getId()} is already registered";

        parent::__construct($message, $code, $previous);
    }
}
