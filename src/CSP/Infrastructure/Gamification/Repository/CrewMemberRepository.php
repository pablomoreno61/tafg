<?php

namespace CSP\Infrastructure\Gamification\Repository;

use CSP\Domain\Gamification\Entity\CrewMember;
use CSP\Domain\Gamification\Repository\CrewMemberRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class CrewMemberRepository extends EntityRepository implements CrewMemberRepositoryInterface
{
    public function save(CrewMember $crewMember)
    {
        $this->getEntityManager()->persist($crewMember);
        $this->getEntityManager()->flush();
    }
}
