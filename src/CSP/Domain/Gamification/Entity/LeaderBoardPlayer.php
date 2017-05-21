<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Domain\User\Entity\User;
use CSP\Infrastructure\Date\Entity\History;

class LeaderBoardPlayer extends History
{
    private $currentPosition;

    private $latestPosition;

    private $credits = 0;

    private $user;

    private $leaderBoard;

    /**
     * @return mixed
     */
    public function getCurrentPosition()
    {
        return $this->currentPosition;
    }

    /**
     * @param mixed $currentPosition
     * @return LeaderBoardPlayer
     */
    public function setCurrentPosition($currentPosition)
    {
        $this->currentPosition = $currentPosition;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLatestPosition()
    {
        return $this->latestPosition;
    }

    /**
     * @param mixed $latestPosition
     * @return LeaderBoardPlayer
     */
    public function setLatestPosition($latestPosition)
    {
        $this->latestPosition = $latestPosition;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCredits()
    {
        return $this->credits;
    }

    public function incCredits(float $credits)
    {
        return $this->setCredits($this->credits + $credits);
    }

    /**
     * @param mixed $creditsEarned
     * @return LeaderBoardPlayer
     */
    public function setCredits(float $credits)
    {
        $this->credits = $credits;
        return $this;
    }

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setLeaderBoard(LeaderBoard $leaderBoard)
    {
        $this->leaderBoard = $leaderBoard;
        return $this;
    }

    public function getLeaderBoard()
    {
        return $this->leaderBoard;
    }
}
