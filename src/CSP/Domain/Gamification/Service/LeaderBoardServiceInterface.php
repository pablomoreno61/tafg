<?php

namespace CSP\Domain\Gamification\Service;

use CSP\Domain\Gamification\Entity\LeaderBoard;

interface LeaderBoardServiceInterface
{
    public function listLeaderBoardPlayers(int $leaderBoardId);

    public function findOneLeaderBoardBy(array $criteria);

    public function saveLeaderBoard(LeaderBoard $leaderBoard);

    public function addLeaderBoardPlayer(int $userId, int $leaderBoardId);
}