<?php

namespace CSP\Domain\Gamification\Repository;

use CSP\Domain\Gamification\Entity\Rank;

interface RankRepositoryInterface
{
    public function save(Rank $rank);

    public function findOneBy(array $criteria, array $orderBy = null);

    public function findRankByScore(int $scoreLimit);
}
