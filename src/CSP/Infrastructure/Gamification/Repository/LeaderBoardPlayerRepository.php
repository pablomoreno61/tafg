<?php

namespace CSP\Infrastructure\Gamification\Repository;

use CSP\Domain\Gamification\Entity\LeaderBoardPlayer;
use CSP\Domain\Gamification\Repository\LeaderBoardPlayerRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class LeaderBoardPlayerRepository extends EntityRepository implements LeaderBoardPlayerRepositoryInterface
{
    public function save(LeaderBoardPlayer $leaderBoardPlayer)
    {
        $this->getEntityManager()->persist($leaderBoardPlayer);
        $this->getEntityManager()->flush();
    }

    public function getLatestPosition(int $leaderBoardId)
    {

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb
            ->select(array('COUNT(leaderBoardPlayer.user)'))
            ->from('CSP\Domain\Gamification\Entity\LeaderBoardPlayer', 'leaderBoardPlayer')
            ->innerJoin('leaderBoardPlayer.leaderBoard', 'leaderBoard')
            ->where(
                $qb->expr()->eq('leaderBoard', $leaderBoardId)
            );

        return $qb->getQuery()->getSingleScalarResult();
    }
}
