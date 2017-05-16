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
}
