<?php

namespace CSP\Domain\Finance\Service;

use CSP\Domain\Finance\Entity\Reward;
use CSP\Domain\Finance\Repository\RewardRepositoryInterface;
use CSP\Domain\Finance\Exception\RewardAlreadyExistsException;
use CSP\Domain\Mission\Entity\Mission;
use CSP\Domain\Mission\Service\MissionService;
use CSP\Domain\Mission\Service\MissionServiceInterface;
use CSP\Domain\User\Service\UserServiceInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class RewardService
{
    private $rewardRepository;

    private $userService;

    private $missionService;

    public function __construct(
        RewardRepositoryInterface $rewardRepository,
        UserServiceInterface $userService,
        MissionServiceInterface $missionService
    ) {
        $this->rewardRepository = $rewardRepository;

        $this->userService = $userService;

        $this->missionService = $missionService;
    }

    public function addReward($userId, string $name, float $credits)
    {
        $user = $this->userService->findUserById($userId);

        $reward = new Reward($user, $name, $credits);

        try {
            $this->rewardRepository->save($reward);
        } catch (UniqueConstraintViolationException $e) {
            throw new RewardAlreadyExistsException($reward);
        }

        $rewards = $this->rewardService->findUserRewards($userId);

        if (count($rewards) == MissionService::MIN_NUMBER_REWARDS) {
            $mission = $this->missionService->findOneMissionBy(array('name' => MissionService::FIRST_POKER_NAME));
            $this->addReward($userId, $mission->getName(), $mission->getScore());

            // @todo: Create medal
        }

        // @todo: Createp rize

        return $reward;
    }

    public function findUserRewards($userId)
    {
        $user = $this->userService->findUserById($userId);

        return $this->rewardRepository->findBy(array('user' => $user));
    }
}