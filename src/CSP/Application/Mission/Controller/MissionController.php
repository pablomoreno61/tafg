<?php

namespace CSP\Application\Mission\Controller;

use CSP\Application\Shared\Controller\SharedController;
use Doctrine\Common\Util\Debug;

class MissionController extends SharedController
{
    public function indexAction()
    {
        $mission = $this->missionService->findMissionById(1);

        $rewards = $this->rewardService->findUserRewards(
            $this->session->user->getId()
        );

        $campaigns = array(
            array('credits' => 0.1, 'name' => 'first_campaign', 'title' => 'Campanya 1', 'isRewarded' => false),
            array('credits' => 0.1, 'name' => 'second_campaign', 'title' => 'Campanya 2', 'isRewarded' => false),
            array('credits' => 0.1, 'name' => 'third_campaign', 'title' => 'Campanya 3', 'isRewarded' => false),
            array('credits' => 0.1, 'name' => 'fourth_campaign', 'title' => 'Campanya 4', 'isRewarded' => false)
        );

        foreach ($rewards as $reward) {
            foreach ($campaigns as $id => $campaign) {
                if ($reward->getName() == $campaign['name']) {
                    $campaigns[$id]['isRewarded'] = true;
                    break;
                }
            }
        }

        $this->view->rewards = $rewards;
        $this->view->campaigns = $campaigns;
        $this->view->mission = $mission;
    }
}
