<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Domain\User\Entity\User;
use CSP\Infrastructure\Date\Entity\History;

class EarnedMedal extends History
{
    private $user;

    private $medal;

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setMedal(Medal $medal)
    {
        $this->medal = $medal;

        return $this;
    }

    public function getMedal()
    {
        return $this->medal;
    }
}
