<?php

namespace CSP\Domain\Gamification\Repository;

use CSP\Domain\Gamification\Entity\LeaderBoardPlayer;

interface LeaderBoardPlayerRepositoryInterface
{
    public function save(LeaderBoardPlayer $leaderBoardPlayer);

    public function findOneBy(array $criteria, array $orderBy = null);
}