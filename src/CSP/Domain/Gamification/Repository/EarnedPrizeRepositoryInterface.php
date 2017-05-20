<?php

namespace CSP\Domain\Gamification\Repository;

use CSP\Domain\Gamification\Entity\EarnedPrize;

interface EarnedPrizeRepositoryInterface
{
    public function save(EarnedPrize $earnedPrize);
}
