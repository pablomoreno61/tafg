<?php

namespace CSP\Domain\Gamification\Repository;

use CSP\Domain\Gamification\Entity\Crew;

interface CrewRepositoryInterface
{
    public function save(Crew $crew);

    public function findOneBy(array $criteria, array $orderBy = null);
}