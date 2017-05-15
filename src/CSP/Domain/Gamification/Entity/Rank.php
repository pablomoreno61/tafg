<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Infrastructure\Date\Entity\History;

class Rank extends History
{
    private $id;

    private $text;

    private $isActive = true;

    private $scoreLimit;

    private $nextRank;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Rank
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
     * @return Rank
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
     * @return Rank
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScoreLimit()
    {
        return $this->scoreLimit;
    }

    /**
     * @param mixed $scoreLimit
     * @return Rank
     */
    public function setScoreLimit($scoreLimit)
    {
        $this->scoreLimit = $scoreLimit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNextRank()
    {
        return $this->nextRank;
    }

    /**
     * @param mixed $nextRank
     * @return Rank
     */
    public function setNextRank(Rank $nextRank)
    {
        $this->nextRank = $nextRank;
        return $this;
    }
}
