<?php

namespace CSP\Application\Mission\Controller;

use CSP\Application\Shared\Controller\SharedController;
use Doctrine\Common\Util\Debug;

class MissionController extends SharedController
{
    public function indexAction()
    {
        $mission = $this->missionService->findMissionById(1);

        $this->view->rewards = $this->rewardService->findUserRewards(
            $this->session->user->getId()
        );

        $this->view->mission = $mission;
    }
}
