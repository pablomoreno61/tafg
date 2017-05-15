<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Infrastructure\Date\Entity\History;

class LeaderBoard extends History
{
    private $id;

    private $text;

    private $isActive = true;

    private $leaderBoardPlayers;

    public function __construct()
    {
        $this->leaderBoardPlayers = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return LeaderBoard
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return LeaderBoard
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function isActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     * @return LeaderBoard
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }


}