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

    public function countRewardsByUser(int $userId)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select(array('COUNT(reward.id)'))
            ->from('CSP\Domain\Finance\Entity\Reward', 'reward')
            ->where($qb->expr()->orX(
                $qb->expr()->eq('reward.isActive', true)
            ));

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function findUserBalance(int $userId)
    {
        // TODO: Implement findUserBalance() method.
    }
}