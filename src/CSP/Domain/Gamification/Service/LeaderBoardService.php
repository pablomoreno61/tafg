<?php

namespace CSP\Domain\Gamification\Service;

use CSP\Domain\Finance\Exception\LeaderBoardPlayerAlreadyExistsException;
use CSP\Domain\Gamification\Entity\LeaderBoard;
use CSP\Domain\Gamification\Entity\LeaderBoardPlayer;
use CSP\Domain\Gamification\Repository\LeaderBoardPlayerRepositoryInterface;
use CSP\Domain\Gamification\Repository\LeaderBoardRepositoryInterface;
use CSP\Domain\User\Service\UserServiceInterface;

class LeaderBoardService implements LeaderBoardServiceInterface
{
    private $leaderBoardRepository;
    private $leaderBoarPlayerRepository;

    private $userService;

    public function __construct(
        LeaderBoardRepositoryInterface $leaderBoardRepository,
        LeaderBoardPlayerRepositoryInterface $leaderBoardPlayerRepository,
        UserServiceInterface $userService
    ) {
        $this->leaderBoardRepository = $leaderBoardRepository;
        $this->leaderBoarPlayerRepository = $leaderBoardPlayerRepository;

        $this->userService = $userService;
    }

    public function listLeaderBoardPlayers(int $leaderBoardId)
    {
        $leaderBoardPlayers = $this->leaderBoarPlayerRepository->findBy(
            array('leaderBoard' => $leaderBoardId),
            array('credits' => 'DESC')
        );

        foreach ($leaderBoardPlayers as $index => $leaderBoardPlayer) {
            $currentPosition = $index + 1;
            $latestPosition = $leaderBoardPlayer->getCurrentPosition();

            $leaderBoardPlayer
                ->setCurrentPosition($currentPosition)
                ->setLatestPosition($latestPosition);

            $this->leaderBoarPlayerRepository->save($leaderBoardPlayer);
        }

        return $leaderBoardPlayers;
    }

    public function findOneLeaderBoardBy(array $criteria)
    {
        return $this->leaderBoardRepository->findOneBy($criteria);
    }

    public function saveLeaderBoard(LeaderBoard $leaderBoard)
    {
        $this->leaderBoardRepository->save($leaderBoard);

        return $leaderBoard;
    }

    public function updateLeaderBoardPlayer(int $userId, int $leaderBoardId, float $creditsEarned)
    {
        $leaderBoardPlayer = $this->leaderBoarPlayerRepository->findOneBy(
            array(
                'user' => $userId,
                'leaderBoard' => $leaderBoardId
            )
        );

        if (!$leaderBoardPlayer) {
            $leaderBoardPlayer = $this->addLeaderBoardPlayer($userId, $leaderBoardId);
        }

        $leaderBoardPlayer->incCredits($creditsEarned);

        $this->leaderBoarPlayerRepository->save($leaderBoardPlayer);

        return $leaderBoardPlayer;
    }

    public function addLeaderBoardPlayer(int $userId, int $leaderBoardId)
    {
        $leaderBoardPlayer = $this->leaderBoarPlayerRepository->findOneBy(
            array(
                'user' => $userId,
                'leaderBoard' => $leaderBoardId
            )
        );

        if ($leaderBoardPlayer) {
            throw new LeaderBoardPlayerAlreadyExistsException($leaderBoardPlayer);
        }

        $user = $this->userService->findUserById($userId);
        $leaderBoard = $this->leaderBoardRepository->findOneBy(array('id' => $leaderBoardId));

        $leaderBoardPlayer = new LeaderBoardPlayer();
        $leaderBoardPlayer
            ->setUser($user)
            ->setLeaderBoard($leaderBoard);

        $latestPosition = $this->leaderBoarPlayerRepository->getLatestPosition($leaderBoardId);

        $leaderBoardPlayer->setCurrentPosition(
            $latestPosition + 1
        );

        $this->leaderBoarPlayerRepository->save($leaderBoardPlayer);

        return $leaderBoardPlayer;
    }
}
