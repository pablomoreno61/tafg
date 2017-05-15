<?php

namespace CSP\Domain\Mission\Entity;

use CSP\Infrastructure\Date\Entity\History;

class Mission extends History
{
    protected $id;
    protected $name;
    protected $text;
    protected $isActive = true;
    protected $startAt;
    protected $expireAt;
    protected $score;
    protected $numFeaturedCampaigns;

    public function getId()
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = strtolower($name);
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setActive($isActive)
    {
        $this->isActive = (bool) $isActive;
        return $this;
    }

    public function isActive()
    {
        return (bool) $this->isActive;
    }

    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;
        return $this;
    }

    public function getStartAt()
    {
        if (!empty($this->startAt)) {
            $this->startAt->settimezone(new \DateTimeZone($this->timezone));
        }

        return $this->startAt;
    }

    public function setExpireAt($expireAt)
    {
        $this->expireAt = $expireAt;

        return $this;
    }

    public function getExpireAt()
    {
        if (!empty($this->expireAt)) {
            $this->expireAt->settimezone(new \DateTimeZone($this->timezone));
        }

        return $this->expireAt;
    }

    public function setScore(float $score)
    {
        $this->score = $score;
        return $this;
    }

    public function getScore()
    {
        return $this->score;
    }
}
