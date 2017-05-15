<?php

namespace CSP\Domain\Gamification\Entity;

use CSP\Domain\User\Entity\User;
use CSP\Infrastructure\Date\Entity\History;

class CrewMember extends History
{
    private $user;

    private $crew;

    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setCrew(Crew $crew)
    {
        $this->crew = $crew;

        return $this;
    }

    public function getCrew()
    {
        return $this->crew;
    }
}
