<?php

namespace CSP\Domain\Gamification\Service;

use CSP\Domain\Gamification\Entity\Medal;
use CSP\Domain\Gamification\Entity\Prize;
use CSP\Domain\Gamification\Entity\Rank;
use CSP\Domain\Gamification\Repository\MedalRepositoryInterface;
use CSP\Domain\Gamification\Repository\PrizeRepositoryInterface;
use CSP\Domain\Gamification\Repository\RankRepositoryInterface;

class RankService
{
    private $medalRepository;
    private $prizeRepository;
    private $rankRepository;

    public function __construct(
        MedalRepositoryInterface $medalRepository,
        PrizeRepositoryInterface $prizeRepository,
        RankRepositoryInterface $rankRepository
    ) {
        $this->medalRepository = $medalRepository;
        $this->prizeRepository = $prizeRepository;
        $this->rankRepository = $rankRepository;
    }

    /**
     * @todo
     * @param $userId
     * @param $medalId
     */
    public function addEarnedMedal($userId, $medalId)
    {

    }

    public function findOneMedalBy(array $criteria)
    {
        return $this->medalRepository->findOneBy($criteria);
    }

    public function saveMedal(Medal $medal)
    {
        $this->medalRepository->save($medal);

        return $medal;
    }

    public function findOneRankBy(array $criteria)
    {
        return $this->rankRepository->findOneBy($criteria);
    }

    public function saveRank(Rank $rank)
    {
        $this->rankRepository->save($rank);

        return $rank;
    }

    public function findOnePrizeBy(array $criteria)
    {
        return $this->prizeRepository->findOneBy($criteria);
    }

    public function savePrize(Prize $prize)
    {
        $this->prizeRepository->save($prize);

        return $prize;
    }
}
