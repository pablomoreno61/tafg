<?php

namespace CSP\Domain\Finance\Entity;

use CSP\Domain\User\Entity\User;
use CSP\Infrastructure\Date\Entity\History;

class Reward extends History
{
    private $id;

    private $name;

    private $isActive = true;

    private $credits = 0;

    private $user;

    public function __construct(User $user, string $name, float $credits)
    {
        parent::__construct();

        $this
            ->setUser($user)
            ->setName($name)
            ->setCredits($credits);
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
     * @return Reward
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Reward
     */
    public function setName(string $name)
    {
        $this->name = $name;
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
     * @return Reward
     */
    public function setActive(bool $isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCredits()
    {
        return $this->credits;
    }

    /**
     * @param mixed $credits
     * @return Reward
     */
    public function setCredits(float $credits)
    {
        $this->credits = $credits;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }
}
