<?php

namespace CSP\Domain\Gamification\Repository;

use CSP\Domain\Gamification\Entity\Medal;

interface MedalRepositoryInterface
{
    public function save(Medal $medal);

    public function findOneBy(array $criteria, array $orderBy = null);
}