<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Infrastructure\Date\Entity\History;
use Doctrine\Common\Collections\ArrayCollection;

class Prize extends History
{
    private $id;

    private $text;

    private $isActive = true;

    private $score;

    private $earnedPrizes;

    public function __construct()
    {
        parent::__construct();

        $this->earnedPrizes = new ArrayCollection();
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
     * @return Prize
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
     * @return Prize
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
     * @return Prize
     */
    public function setActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     * @return Prize
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }
}
