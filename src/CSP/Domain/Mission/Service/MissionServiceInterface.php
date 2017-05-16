<?php

namespace CSP\Domain\Mission\Service;

use CSP\Domain\Mission\Entity\Mission;

interface MissionServiceInterface
{
    public function save(Mission $mission);

    public function findMissionById(int $missionId);

    public function findOneMissionBy(array $criteria);
}