<?php

namespace CSP\Domain\Gamification\Repository;

use CSP\Domain\Gamification\Entity\EarnedMedal;

interface EarnedMedalRepositoryInterface
{
    public function save(EarnedMedal $earnedMedal);

}