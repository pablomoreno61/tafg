<?php

namespace CSP\Infrastructure\Finance\Repository;

use CSP\Domain\Finance\Entity\Reward;
use CSP\Domain\Finance\Repository\RewardRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class RewardRepository extends EntityRepository implements RewardRepositoryInterface
{
    public function save(Reward $reward)
    {
        $this->getEntityManager()->persist($reward);
        $this->getEntityManager()->flush();
    }

    public function findUserBalance(int $userId)
    {
        // TODO: Implement findUserBalance() method.
    }
}