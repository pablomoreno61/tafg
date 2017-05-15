<?php

namespace CSP\Application\Finance\Controller;

class RewardController
{
    /**
     * @todo
     */
    public function addUserRewardAction()
    {
        $credits = $this->request->get('credits');
        $campaignId = $this->request->get('campaignId', 'int', null);

        $this->rewardService->addReward(
            $this->session->user->getId(),
            $credits
        );

        $this->view->campaignId = $campaignId;
    }

    /**
     * @todo
     */
    public function showUserBalanceAction()
    {

    }
}