<?php

namespace CSP\Domain\Gamification\Service;

use CSP\Domain\Gamification\Entity\Medal;
use CSP\Domain\Gamification\Entity\Prize;
use CSP\Domain\Gamification\Entity\Rank;
use CSP\Domain\User\Entity\User;

interface RankServiceInterface
{
    public function addEarnedMedal(User $user, int $medalId);

    public function addEarnedPrize(User $user, int $prizeId);

    public function findOneMedalBy(array $criteria);

    public function saveMedal(Medal $medal);

    public function findOneRankBy(array $criteria);

    public function saveRank(Rank $rank);

    public function findOnePrizeBy(array $criteria);

    public function savePrize(Prize $prize);

    public function findRankByScore(int $scoreLimit);
}