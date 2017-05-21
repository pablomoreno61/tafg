<?php

namespace CSP\Domain\Gamification\Repository;

use CSP\Domain\Gamification\Entity\LeaderBoard;

interface LeaderBoardRepositoryInterface
{
    public function save(LeaderBoard $leaderBoard);

    public function findOneBy(array $criteria, array $orderBy = null);
}