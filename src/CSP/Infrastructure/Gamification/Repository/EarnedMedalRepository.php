<?php

namespace CSP\Infrastructure\Gamification\Repository;

use CSP\Domain\Gamification\Entity\EarnedMedal;
use CSP\Domain\Gamification\Repository\EarnedMedalRepositoryInterface;
use Doctrine\ORM\EntityRepository;

class EarnedMedalRepository extends EntityRepository implements EarnedMedalRepositoryInterface
{
    public function save(EarnedMedal $earnedMedal)
    {
        $this->getEntityManager()->persist($earnedMedal);
        $this->getEntityManager()->flush();
    }
}
