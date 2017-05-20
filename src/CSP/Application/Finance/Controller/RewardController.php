<?php

namespace CSP\Application\Finance\Controller;

use CSP\Application\Shared\Controller\SharedController;
use CSP\Domain\Finance\Exception\RewardAlreadyExistsException;

class RewardController extends SharedController
{
    /**
     * @todo
     */
    public function addUserRewardAction()
    {
        $credits = $this->request->get('credits');
        $name = $this->request->get('name', 'string', null);

        try {
            $this->rewardService->addReward(
                $this->session->user->getId(),
                $name,
                $credits
            );

            $this->view->message = "Campanya {$name} remunerada correctament.";
        } catch (RewardAlreadyExistsException $e) {
            $this->view->message = 'Aquesta campanya ja ha estat remunerada previament.';
        }
    }

    /**
     * @todo
     */
    public function showUserBalanceAction()
    {
        $userBalance = $this->rewardService->findUserBalance(
            $this->session->user->getId()
        );

        $rewards = $this->rewardService->findUserRewards(
            $this->session->user->getId()
        );

        $this->view->userBalance = $userBalance;
        $this->view->rewards = $rewards;
    }
}