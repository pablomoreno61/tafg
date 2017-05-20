<?php

namespace CSP\Infrastructure\Gamification\Repository;

use CSP\Domain\Gamification\Entity\EarnedPrize;
use CSP\Domain\Gamification\Repository\EarnedPrizeRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class EarnedPrizeRepository extends EntityRepository implements EarnedPrizeRepositoryInterface
{
    public function save(EarnedPrize $earnedPrize)
    {
        $this->getEntityManager()->persist($earnedPrize);
        $this->getEntityManager()->flush();
    }
}
