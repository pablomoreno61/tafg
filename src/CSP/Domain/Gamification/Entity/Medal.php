<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Infrastructure\Date\Entity\History;

class Medal extends History
{
    private $id;

    private $text;

    private $description;

    private $isActive = true;

    private $earnedMedals;

    public function __construct()
    {
        $this->earnedMedals = new ArrayCollection();
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
     * @return Medal
     */
    public function setId(int $id): Medal
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
     * @return Medal
     */
    public function setText(string $text): Medal
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
     * @return Medal
     */
    public function setDescription(string $description): Medal
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return Medal
     */
    public function setActive(bool $isActive): Medal
    {
        $this->isActive = $isActive;
        return $this;
    }
}