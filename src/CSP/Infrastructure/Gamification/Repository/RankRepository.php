<?php

namespace CSP\Infrastructure\Gamification\Repository;

use CSP\Domain\Gamification\Entity\Rank;
use CSP\Domain\Gamification\Repository\RankRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class RankRepository extends EntityRepository implements RankRepositoryInterface
{
    public function save(Rank $rank)
    {
        $this->getEntityManager()->persist($rank);
        $this->getEntityManager()->flush();
    }

    public function findRankByScore(int $scoreLimit)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select(array('rank'))
            ->from('CSP\Domain\Gamification\Entity\Rank', 'rank')
            ->where($qb->expr()->orX(
                $qb->expr()->eq('rank.isActive', true),
                $qb->expr()->gt('rank.scoreLimit', $scoreLimit)
            ))
            ->orderBy('rank.scoreLimit', 'ASC')
            ->setFirstResult(0)
            ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }
}
