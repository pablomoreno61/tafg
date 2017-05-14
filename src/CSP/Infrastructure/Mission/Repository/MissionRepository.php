<?php

namespace CSP\Infrastructure\Mission\Repository;

use CSP\Domain\Mission\Entity\Mission;
use CSP\Domain\Mission\Repository\MissionRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class MissionRepository extends EntityRepository implements MissionRepositoryInterface
{
    public function save(Mission $mission)
    {
        $this->getEntityManager()->persist($mission);
        $this->getEntityManager()->flush();
    }

    public function findMission(int $missionId)
    {
        return $this->findOneBy(array('id' => $missionId));
    }
}