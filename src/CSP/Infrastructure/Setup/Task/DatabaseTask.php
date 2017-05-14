<?php

namespace CSP\Infrastructure\Setup\Task;

use CSP\Domain\Mission\Entity\Mission;
use CSP\Domain\Mission\Service\MissionService;
use Phalcon\CLI\Task as PhTask;

class DatabaseTask extends PhTask
{
    /**
     * php /var/www/tfg/bin/cli.php dev setup/database createDatabase
     */
    public function createDatabaseAction()
    {
        $startAt = new \DateTime();
        $expireAt = new \DateTime();
        $expireAt->add(new \DateInterval('P365D'));

        $mission = new Mission();
        $mission
            ->setName('first_poker')
            ->setText('Primer poker')
            ->setActive(true)
            ->setStartAt($startAt)
            ->setExpireAt($expireAt)
            ->setScore(4);

        $this->missionService->save($mission);
    }
}