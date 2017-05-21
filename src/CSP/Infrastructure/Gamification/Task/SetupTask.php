<?php

namespace CSP\Infrastructure\Gamification\Task;

use CSP\Domain\Gamification\Entity\LeaderBoard;
use CSP\Domain\Gamification\Entity\Medal;
use CSP\Domain\Gamification\Entity\Prize;
use CSP\Domain\Gamification\Entity\Rank;
use CSP\Domain\Mission\Entity\Mission;
use Phalcon\CLI\Task as PhTask;

class SetupTask extends PhTask
{
    /**
     * php /var/www/tfg/bin/cli.php dev gamification/setup initial
     */
    public function initialAction()
    {
        $this->createMissionsAction();

        $this->createMedalsAction();

        $this->createPrizesAction();

        $this->createRanksAction();
    }

    /**
     * php /var/www/tfg/bin/cli.php dev gamification/setup createMissions
     */
    public function createMissionsAction()
    {
        $startAt = new \DateTime();
        $expireAt = new \DateTime();
        $expireAt->add(new \DateInterval('P365D'));

        $mission = $this->missionService->findOneMissionBy(array('name' => 'first_poker'));

        if (empty($mission)) {
            $mission = new Mission();
        }

        $mission
            ->setName('first_poker')
            ->setText('Primer poker')
            ->setActive(true)
            ->setStartAt($startAt)
            ->setExpireAt($expireAt)
            ->setScore(3.6);

        $this->missionService->save($mission);
    }

    /**
     * php /var/www/tfg/bin/cli.php dev gamification/setup createMedals
     */
    public function createMedalsAction()
    {
        $medalTexts = array(
            'T\'has registrat',
            'Has completat el teu perfil',
            'Has fet el teu primer click',
            'Has fet el teu primer registre',
            'Has fet la teva primera compra cashback',
            'Has completat el teu primer poker',
            'Has completat la teva primera ruleta',
            'Has portat el teu primer afiliat',
            'Has portat 10 afiliats',
            'Has cobrat per primera vegada',
            'Has completat l\'enquesta de perfilació',
            'Has personalitzat el perfil',
            '5 logins consecutius en 5 dies diferents',
            'Has fet click en 25 campanyes diferents',
            'T\'has registrat en 25 campanyes de registre',
            'Has realitzat 25 compres cashback',
            'Has completat 10 pokers',
            'Has completat 10 ruletes',
            'Has creat una tripulació'
        );

        foreach ($medalTexts as $medalText) {
            $medal = $this->rankService->findOneMedalBy(array('text' => $medalText));

            if (empty($medal)) {
                $medal = new Medal();
            }

            $medal
                ->setText($medalText)
                ->setDescription('Descripció detallada de la ' . $medalText)
                ->setActive(true);

            $this->rankService->saveMedal($medal);
        }
    }

    /**
     * php /var/www/tfg/bin/cli.php dev gamification/setup createRanks
     */
    public function createRanksAction()
    {
        $ranksData = array(
            array('text' => 'Almirall', 'scoreLimit' => 20000, 'nextRank' => null),
            array('text' => 'Comodor', 'scoreLimit' => 10000, 'nextRank' => 'Almirall'),
            array('text' => 'Capità', 'scoreLimit' => 5000, 'nextRank' => 'Comodor'),
            array('text' => 'Comandant', 'scoreLimit' => 2000, 'nextRank' => 'Capità'),
            array('text' => 'Tinent', 'scoreLimit' => 1000, 'nextRank' => 'Comandant'),
            array('text' => 'Tripulant', 'scoreLimit' => 300, 'nextRank' => 'Tinent')
        );

        foreach ($ranksData as $rankData) {
            $rank = $this->rankService->findOneRankBy(array('text' => $rankData['text']));

            if (empty($rank)) {
                $rank = new Rank();
            }

            $nextRank = null;
            if (!empty($rankData['nextRank'])) {
                $rank->setNextRank(
                    $this->rankService->findOneRankBy(array('text' => $rankData['nextRank']))
                );
            }

            $rank
                ->setText($rankData['text'])
                ->setScoreLimit($rankData['scoreLimit'])
                ->setActive(true);

            $this->rankService->saveRank($rank);
        }
    }

    /**
     * php /var/www/tfg/bin/cli.php dev gamification/setup createPrizes
     */
    public function createPrizesAction()
    {
        $prizesData = array(
            array('text' => 'Per medalla guanyada', 'score' => 25),
            array('text' => 'Per completar el poker', 'score' => 20),
            array('text' => 'Per compra cashback', 'score' => 10),
            array('text' => 'Per respondre enquesta', 'score' => 5),
            array('text' => 'Per registre', 'score' => 5),
            array('text' => 'Per portar un afiliat', 'score' => 2),
            array('text' => 'Per click en e-mail', 'score' => 2),
            array('text' => 'Per apertura en e-mail', 'score' => 1),
            array('text' => 'Per inici de sessió', 'score' => 1),
            array('text' => '30 dies sense activitat', 'score' => -25)
        );

        foreach ($prizesData as $prizeData) {
            $prize = $this->rankService->findOnePrizeBy(array('text' => $prizeData['text']));

            if (empty($prize)) {
                $prize = new Prize();
            }

            $prize
                ->setText($prizeData['text'])
                ->setScore($prizeData['score'])
                ->setActive(true);

            $this->rankService->savePrize($prize);
        }
    }

    /**
     * php /var/www/tfg/bin/cli.php dev gamification/setup createLeaderBoards
     */
    public function createLeaderBoardsAction()
    {
        $leaderboardsData = array(
            array(
                'text' => 'Classificació històrica per punts',
                'description' => 'Classificació basada en el sumatori total de punts aconseguits per cada usuari'
            ),
            array(
                'text' => 'Classificació anual per punts',
                'description' => 'Classificació de temporada anual amb el sumatori de punts aconseguits durant l\'any en curs'
            ),
            array(
                'text' => 'Classificació mensual per punts',
                'description' => 'Classificació basada en el sumatori de punts aconseguits durant el mes en curs'
            ),
            array(
                'text' => 'Classificació anual per punts directes',
                'description' => 'Classificació de temporada anual amb el sumatori de punts directes aconseguits durant l\'any en curs'
            ),
            array(
                'text' => 'Classificació mensual per punts directes',
                'description' => 'Classificació basada en el sumatori de punts directes aconseguits durant el mes en curs'
            )
        );

        foreach ($leaderboardsData as $leaderboardData) {
            $leaderboard = $this->leaderBoardService->findOneLeaderBoardBy(array('text' => $leaderboardData['text']));

            if (empty($leaderboard)) {
                $leaderboard = new LeaderBoard();
            }

            $leaderboard
                ->setText($leaderboardData['text'])
                ->setDescription($leaderboardData['description'])
                ->setActive(true);

            $this->leaderBoardService->saveLeaderBoard($leaderboard);
        }
    }
}