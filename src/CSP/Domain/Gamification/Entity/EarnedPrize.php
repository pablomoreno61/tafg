<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Domain\User\Entity\User;
use CSP\Infrastructure\Date\Entity\History;

class EarnedPrize extends History
{
    private $user;

    private $prize;

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setPrize(Prize $prize)
    {
        $this->prize = $prize;

        return $this;
    }

    public function getPrize()
    {
        return $this->prize;
    }
}
