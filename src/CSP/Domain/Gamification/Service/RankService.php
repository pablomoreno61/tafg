<?php

namespace CSP\Domain\Gamification\Service;

use CSP\Domain\Gamification\Entity\EarnedMedal;
use CSP\Domain\Gamification\Entity\EarnedPrize;
use CSP\Domain\Gamification\Entity\Medal;
use CSP\Domain\Gamification\Entity\Prize;
use CSP\Domain\Gamification\Entity\Rank;
use CSP\Domain\Gamification\Repository\EarnedMedalRepositoryInterface;
use CSP\Domain\Gamification\Repository\EarnedPrizeRepositoryInterface;
use CSP\Domain\Gamification\Repository\MedalRepositoryInterface;
use CSP\Domain\Gamification\Repository\PrizeRepositoryInterface;
use CSP\Domain\Gamification\Repository\RankRepositoryInterface;
use CSP\Domain\User\Entity\User;
use CSP\Domain\User\Service\UserServiceInterface;

class RankService implements RankServiceInterface
{
    private $medalRepository;
    private $prizeRepository;
    private $rankRepository;
    private $earnedMedalRepository;
    private $earnedPrizeRepository;

    private $userService;

    public function __construct(
        MedalRepositoryInterface $medalRepository,
        PrizeRepositoryInterface $prizeRepository,
        RankRepositoryInterface $rankRepository,
        EarnedMedalRepositoryInterface $earnedMedalRepository,
        EarnedPrizeRepositoryInterface $earnedPrizeRepository,
        UserServiceInterface $userService
    ) {
        $this->medalRepository = $medalRepository;
        $this->prizeRepository = $prizeRepository;
        $this->rankRepository = $rankRepository;
        $this->earnedMedalRepository = $earnedMedalRepository;
        $this->earnedPrizeRepository = $earnedPrizeRepository;

        $this->userService = $userService;
    }

    /**
     * @param User $user
     * @param int $medalId
     */
    public function addEarnedMedal(User $user, int $medalId)
    {
        $medal = $this->findOneMedalBy(array('id' => $medalId));

        $earnedMedal = new EarnedMedal();
        $earnedMedal
            ->setUser($user)
            ->setMedal($medal);

        $this->earnedMedalRepository->save($earnedMedal);

        $this->addEarnedPrize($user, Prize::MEDAL_EARNED);
    }

    /**
     * @param User $user
     * @param int $prizeId
     */
    public function addEarnedPrize(User $user, int $prizeId)
    {
        $prize = $this->findOnePrizeBy(array('id' => $prizeId));

        $earnedPrize = new EarnedPrize();
        $earnedPrize
            ->setUser($user)
            ->setPrize($prize);

        $this->earnedPrizeRepository->save($earnedPrize);

        $user->incRankScore($prize->getScore());
        $this->userService->save($user);
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

    public function findRankByScore(int $scoreLimit)
    {
        return $this->rankRepository->findRankByScore($scoreLimit);
    }
}
