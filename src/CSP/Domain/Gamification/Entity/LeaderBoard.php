<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Infrastructure\Date\Entity\History;
use Doctrine\Common\Collections\ArrayCollection;

class LeaderBoard extends History
{
    const HISTORIC_BY_POINTS = 1;

    private $id;

    private $text;

    private $description;

    private $isActive = true;

    private $leaderBoardPlayers;

    public function __construct()
    {
        parent::__construct();

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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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

    /**
     * @return ArrayCollection
     */
    public function getLeaderBoardPlayers()
    {
        return $this->leaderBoardPlayers;
    }

    /**
     * @param ArrayCollection $leaderBoardPlayers
     * @return LeaderBoard
     */
    public function setLeaderBoardPlayers($leaderBoardPlayers): LeaderBoard
    {
        $this->leaderBoardPlayers = $leaderBoardPlayers;
        return $this;
    }
}
