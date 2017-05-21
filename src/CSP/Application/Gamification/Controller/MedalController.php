<?php

namespace CSP\Application\Gamification\Controller;

use CSP\Application\Shared\Controller\SharedController;

class MedalController extends SharedController
{
    public function showEarnedMedalsAction()
    {
        $userId = $this->request->get('userId', 'int', $this->session->user->getId());

        $earnedMedals = $this->rankService->findEarnedMedals($userId);

        $medals = $this->rankService->findAllMedals();

        $userMedals = array();
        foreach ($medals as $medal) {
            $userMedal = array('medal' => $medal, 'isEarned' => false);

            foreach ($earnedMedals as $earnedMedal) {
                if ($medal->getId() === $earnedMedal->getMedal()->getId()) {
                    $userMedal['isEarned'] = true;
                }
            }

            $userMedals[] = $userMedal;
        }

        $this->view->userMedals = $userMedals;
    }
}