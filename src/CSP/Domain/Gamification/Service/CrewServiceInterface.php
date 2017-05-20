<?php

namespace CSP\Domain\Gamification\Service;

interface CrewServiceInterface
{
    public function save($userId, string $text, $logo);

    public function findCrewByUser($userId);

    public function findCrewMembers(int $crewId);
}