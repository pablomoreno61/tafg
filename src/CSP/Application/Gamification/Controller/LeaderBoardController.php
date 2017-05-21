<?php

namespace CSP\Application\Gamification\Controller;

use CSP\Application\Shared\Controller\SharedController;
use CSP\Domain\Gamification\Entity\LeaderBoard;

class LeaderBoardController extends SharedController
{
    public function showPlayersAction()
    {
        $leaderBoard = $this->leaderBoardService->findOneLeaderBoardBy(array('id' => LeaderBoard::HISTORIC_BY_POINTS));

        $lLeaderBoardPlayers = $this->leaderBoardService->listLeaderBoardPlayers(LeaderBoard::HISTORIC_BY_POINTS);

        $this->view->leaderBoard = $leaderBoard;
        $this->view->leaderBoardPlayers = $lLeaderBoardPlayers;
    }
}
