<?php

namespace CSP\Infrastructure\Gamification\Repository;

use CSP\Domain\Gamification\Entity\Medal;
use CSP\Domain\Gamification\Repository\MedalRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class MedalRepository extends EntityRepository implements MedalRepositoryInterface
{
    public function save(Medal $medal)
    {
        $this->getEntityManager()->persist($medal);
        $this->getEntityManager()->flush();
    }
}
