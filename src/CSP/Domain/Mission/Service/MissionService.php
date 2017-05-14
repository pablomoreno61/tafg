<?php

namespace CSP\Domain\Mission\Service;

use CSP\Domain\Mission\Entity\Mission;
use CSP\Domain\Mission\Repository\MissionRepositoryInterface;

class MissionService
{
    private $missionRepository;

    public function __construct(MissionRepositoryInterface $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function save(Mission $mission)
    {
        $this->missionRepository->save($mission);
    }

    public function findMission(int $missionId)
    {
        return $this->missionRepository->findMission($missionId);
    }
}