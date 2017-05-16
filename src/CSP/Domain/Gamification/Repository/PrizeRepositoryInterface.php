<?php

namespace CSP\Domain\Gamification\Repository;

use CSP\Domain\Gamification\Entity\Prize;

interface PrizeRepositoryInterface
{
    public function save(Prize $prize);

    public function findOneBy(array $criteria, array $orderBy = null);
}
