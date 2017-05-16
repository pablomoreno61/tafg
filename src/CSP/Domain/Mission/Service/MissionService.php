<?php

namespace CSP\Domain\Mission\Service;

use CSP\Domain\Mission\Entity\Mission;
use CSP\Domain\Mission\Repository\MissionRepositoryInterface;

class MissionService implements MissionServiceInterface
{
    const MIN_NUMBER_REWARDS = 4;
    const FIRST_POKER_NAME = 'first_poker';

    private $missionRepository;

    public function __construct(MissionRepositoryInterface $missionRepository)
    {
        $this->missionRepository = $missionRepository;
    }

    public function save(Mission $mission)
    {
        $this->missionRepository->save($mission);
    }

    public function findMissionById(int $missionId)
    {
        return $this->missionRepository->findOneBy(array('id' => $missionId));
    }

    public function findOneMissionBy(array $criteria)
    {
        return $this->missionRepository->findOneBy($criteria);
    }
}