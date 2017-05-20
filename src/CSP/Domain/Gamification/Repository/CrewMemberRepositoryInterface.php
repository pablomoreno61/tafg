<?php

namespace CSP\Domain\Gamification\Repository;

use CSP\Domain\Gamification\Entity\CrewMember;

interface CrewMemberRepositoryInterface
{
    public function save(CrewMember $crewMember);

    public function findBy(array $criteria, array $orderBy = null);
}