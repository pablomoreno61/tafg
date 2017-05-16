<?php

namespace CSP\Domain\Mission\Repository;

use CSP\Domain\Mission\Entity\Mission;

interface MissionRepositoryInterface
{
    public function save(Mission $mission);

    public function findOneBy(array $criteria, array $orderBy = null);
}