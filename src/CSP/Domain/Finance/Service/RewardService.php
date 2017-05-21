<?php

namespace CSP\Domain\Finance\Service;

use CSP\Domain\Finance\Entity\Reward;
use CSP\Domain\Finance\Repository\RewardRepositoryInterface;
use CSP\Domain\Finance\Exception\RewardAlreadyExistsException;
use CSP\Domain\Gamification\Entity\LeaderBoard;
use CSP\Domain\Gamification\Entity\Medal;
use CSP\Domain\Gamification\Entity\Prize;
use CSP\Domain\Gamification\Service\LeaderBoardServiceInterface;
use CSP\Domain\Gamification\Service\RankServiceInterface;
use CSP\Domain\Mission\Service\MissionService;
use CSP\Domain\Mission\Service\MissionServiceInterface;
use CSP\Domain\User\Service\UserServiceInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class RewardService
{
    private $rewardRepository;

    private $leaderBoardService;

    private $rankService;

    private $userService;

    private $missionService;

    public function __construct(
        RewardRepositoryInterface $rewardRepository,
        LeaderBoardServiceInterface $leaderBoardService,
        RankServiceInterface $rankService,
        UserServiceInterface $userService,
        MissionServiceInterface $missionService
    ) {
        $this->rewardRepository = $rewardRepository;

        $this->leaderBoardService = $leaderBoardService;

        $this->rankService = $rankService;

        $this->userService = $userService;

        $this->missionService = $missionService;
    }

    public function findUserBalance($userId)
    {
        $rewards = $this->findUserRewards($userId);

        $userBalance = 0;
        foreach ($rewards as $reward) {
            $userBalance += $reward->getCredits();
        }

        return $userBalance;
    }

    public function addReward($userId, string $name, float $credits)
    {
        $user = $this->userService->findUserById($userId);

        // if is first the reward, create medal
        $numRewards = $this->countRewardsByUser($userId);

        if ($numRewards == 0) {
            $this->rankService->addEarnedMedal($user, Medal::FIRST_LEAD);
        }

        $reward = new Reward($user, $name, $credits);

        try {
            $this->rewardRepository->save($reward);
        } catch (UniqueConstraintViolationException $e) {
            throw new RewardAlreadyExistsException($reward);
        }

        $rewards = $this->findUserRewards($userId);

        if (count($rewards) == MissionService::MIN_NUMBER_REWARDS) {
            $mission = $this->missionService->findOneMissionBy(array('name' => MissionService::FIRST_POKER_NAME));
            $this->addReward($userId, $mission->getName(), $mission->getScore());

            // if first poker, create medal
            $this->rankService->addEarnedMedal($user, Medal::FIRST_POKER);
            $this->rankService->addEarnedPrize($user, Prize::POKER_COMPLETED);
        }

        // Create prize allways
        $this->rankService->addEarnedPrize($user, Prize::LEAD_REWARDED);

        // Update leader board player credits
        $this->leaderBoardService->updateLeaderBoardPlayer(
            $userId,
            LeaderBoard::HISTORIC_BY_POINTS,
            $reward->getCredits()
        );

        return $reward;
    }

    public function findUserRewards($userId)
    {
        $user = $this->userService->findUserById($userId);

        return $this->rewardRepository->findBy(array('user' => $user));
    }

    public function countRewardsByUser(int $userId)
    {
        return $this->rewardRepository->countRewardsByUser($userId);
    }
}