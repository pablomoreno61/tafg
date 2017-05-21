<?php

namespace CSP\Infrastructure\Gamification\Repository;

use CSP\Domain\Gamification\Entity\LeaderBoard;
use CSP\Domain\Gamification\Repository\LeaderBoardRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class LeaderBoardRepository extends EntityRepository implements LeaderBoardRepositoryInterface
{
    public function save(LeaderBoard $leaderBoard)
    {
        $this->getEntityManager()->persist($leaderBoard);
        $this->getEntityManager()->flush();
    }
}
