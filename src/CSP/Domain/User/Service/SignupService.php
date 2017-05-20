<?php

namespace CSP\Domain\User\Service;

use CSP\Domain\Gamification\Service\CrewServiceInterface;
use CSP\Domain\Gamification\Service\RankServiceInterface;
use CSP\Domain\User\Entity\User;
use CSP\Domain\User\Exception\UserAlreadyExistsException;
use CSP\Domain\User\Repository\UserRepositoryInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class SignupService implements SignupServiceInterface
{
    private $userRepository;
    private $crewService;
    private $rankService;

    public function __construct(
        UserRepositoryInterface $userRepository,
        CrewServiceInterface $crewService,
        RankServiceInterface $rankService
    ) {
        $this->userRepository = $userRepository;
        $this->crewService = $crewService;
        $this->rankService = $rankService;
    }

    public function signup(string $email, string $password, string $refererEmail = null)
    {
        $user = new User();
        $user
            ->setEmail($email)
            ->setPassword($password)
            ->setActive(true);

        // Add rank
        $rank = $this->rankService->findRankByScore($user->getRankScore());
        $user->setRank($rank);

        // Add user referer
        $userReferer = $this->userRepository->findOneBy(array('email' => $refererEmail));

        if (!empty($userReferer)) {
            $user->setUserReferer($userReferer);
        }

        try {
            $this->userRepository->save($user);
        } catch (UniqueConstraintViolationException $e) {
            echo $e->getMessage();
            throw new UserAlreadyExistsException($user);
        }

        // Add to crew if needed
        if (!empty($userReferer)) {
            $crew = $this->crewService->findCrewByUser($userReferer);

            if ($crew) {
                $this->crewService->addCrewMember($user->getId(), $crew->getId());
            }
        }

        return $user;
    }
}
