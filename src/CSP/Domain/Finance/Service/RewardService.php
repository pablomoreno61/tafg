<?php

namespace CSP\Domain\Finance\Service;

use CSP\Domain\Finance\Entity\Reward;
use CSP\Domain\Finance\Repository\RewardRepositoryInterface;
use CSP\Domain\User\Service\UserService;
use CSP\Domain\User\Service\UserServiceInterface;

class RewardService
{
    private $rewardRepository;

    private $userService;

    public function __construct(
        RewardRepositoryInterface $rewardRepository,
        UserServiceInterface $userService
    ) {
        $this->rewardRepository = $rewardRepository;

        $this->userService = $userService;
    }

    public function addReward(int $userId, float $credits)
    {
        $user = $this->userService->findUser($userId);

        $reward = new Reward($user, $credits);

        $this->rewardRepository->save($reward);

        return $reward;
    }
}