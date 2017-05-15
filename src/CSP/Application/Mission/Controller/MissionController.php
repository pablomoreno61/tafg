<?php

namespace CSP\Application\Mission\Controller;

use CSP\Application\Shared\Controller\SharedController;

class MissionController extends SharedController
{
    public function indexAction()
    {
        $mission = $this->missionService->findMission(1);

        $this->view->mission = $mission;
    }
}
