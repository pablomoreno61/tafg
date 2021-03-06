<?php

namespace CSP\Domain\Finance\Repository;

use CSP\Domain\Finance\Entity\Reward;

interface RewardRepositoryInterface
{
    public function save(Reward $reward);

    public function countRewardsByUser(int $userId);

    public function findUserBalance(int $userId);
}