<?php

namespace CSP\Domain\Gamification\Service;

use CSP\Domain\Gamification\Entity\Crew;
use CSP\Domain\Gamification\Entity\CrewMember;
use CSP\Domain\Gamification\Repository\CrewMemberRepositoryInterface;
use CSP\Domain\Gamification\Repository\CrewRepositoryInterface;
use CSP\Domain\User\Service\UserServiceInterface;

class CrewService implements CrewServiceInterface
{
    private $crewRepository;
    private $crewMemberRepository;
    private $userService;

    public function __construct(
        CrewRepositoryInterface $crewRepository,
        CrewMemberRepositoryInterface $crewMemberRepository,
        UserServiceInterface $userService
    ) {
        $this->crewRepository = $crewRepository;
        $this->crewMemberRepository = $crewMemberRepository;

        $this->userService = $userService;
    }

    public function save($userId, string $text, $logo)
    {
        $crew = $this->findCrewByUser($userId);

        if (!$crew) {
            $user = $this->userService->findUserById($userId);

            $crew = new Crew();
            $crew->setUser($user);
        }

        if (!empty($logo)) {
            $logo->moveTo(PROJECT_PATH . '/public/uploads/crews/dev/' . $logo->getName());
            $crew->setLogo($logo->getName());
        }

        $crew
            ->setText($text)
            ->setActive(true);

        $this->crewRepository->save($crew);
    }

    public function findCrewByUser($userId)
    {
        return $this->crewRepository->findOneBy(array('user' => $userId));
    }

    public function findCrewMembers(int $crewId)
    {
        return $this->crewMemberRepository->findBy(array('crew' => $crewId));
    }

    public function addCrewMember($userId, $crewId)
    {
        $user = $this->userService->findUserById($userId);
        $crew = $this->crewRepository->findOneBy(array('id' => $crewId));

        $crewMember = new CrewMember();
        $crewMember
            ->setUser($user)
            ->setCrew($crew);

        $this->crewMemberRepository->save($crewMember);
    }
}
