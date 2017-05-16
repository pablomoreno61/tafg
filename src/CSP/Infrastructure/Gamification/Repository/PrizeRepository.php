<?php

namespace CSP\Infrastructure\Gamification\Repository;

use CSP\Domain\Gamification\Entity\Prize;
use CSP\Domain\Gamification\Repository\PrizeRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class PrizeRepository extends EntityRepository implements PrizeRepositoryInterface
{
    public function save(Prize $prize)
    {
        $this->getEntityManager()->persist($prize);
        $this->getEntityManager()->flush();
    }
}
