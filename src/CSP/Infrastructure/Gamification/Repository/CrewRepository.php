<?php

namespace CSP\Infrastructure\Gamification\Repository;

use CSP\Domain\Gamification\Entity\Crew;
use CSP\Domain\Gamification\Repository\CrewRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class CrewRepository extends EntityRepository implements CrewRepositoryInterface
{
    public function save(Crew $crew)
    {
        $this->getEntityManager()->persist($crew);
        $this->getEntityManager()->flush();
    }
}
