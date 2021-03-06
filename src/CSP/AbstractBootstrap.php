<?php

namespace CSP;

use CSP\Domain\Environment\Exception\UnexpectedConfigFileException;
use CSP\Domain\Finance\Entity\Reward;
use CSP\Domain\Finance\Service\RewardService;
use CSP\Domain\Gamification\Entity\Crew;
use CSP\Domain\Gamification\Entity\CrewMember;
use CSP\Domain\Gamification\Entity\EarnedMedal;
use CSP\Domain\Gamification\Entity\EarnedPrize;
use CSP\Domain\Gamification\Entity\LeaderBoard;
use CSP\Domain\Gamification\Entity\LeaderBoardPlayer;
use CSP\Domain\Gamification\Entity\Medal;
use CSP\Domain\Gamification\Entity\Prize;
use CSP\Domain\Gamification\Entity\Rank;
use CSP\Domain\Gamification\Service\CrewService;
use CSP\Domain\Gamification\Service\LeaderBoardService;
use CSP\Domain\Gamification\Service\RankService;
use CSP\Domain\Mission\Entity\Mission;
use CSP\Domain\Mission\Service\MissionService;
use CSP\Domain\User\Entity\User;
use CSP\Domain\User\Service\AuthenticationService;
use CSP\Domain\User\Service\SignupService;
use CSP\Domain\User\Service\UserService;
use CSP\Infrastructure\Doctrine\DBAL\Types\Password;
use CSP\Infrastructure\Doctrine\DBAL\Types\UTCDateTimeType;
use Doctrine\Common\Cache as DoctrineCache;
use Doctrine\Common\Proxy\AbstractProxyFactory as DoctrineProxy;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Proxy\Autoloader;
use Doctrine\ORM\Tools\Setup;
use Phalcon\Config\Adapter\Yaml as ConfigYaml;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;

abstract class AbstractBootstrap
{
    protected $di;

    abstract public function run();

    public function getDI()
    {
        return $this->di;
    }

    /**
     * Initializes the config. Reads it from its location and
     * stores it in the Di container for easier access
     */
    protected function initConfig()
    {
        $config = $this->getConfigFile(PROJECT_PATH . '/config/common.yml');

        $configLocalized = $this->getConfigFile(PROJECT_PATH . "/config/dev.yml");

        $config->merge($configLocalized);

        // Store it in the Di container
        $this->getDI()->setShared('config', $config);
    }

    protected function getConfigFile($configFileName)
    {
        if (!is_readable($configFileName)) {
            throw new UnexpectedConfigFileException($configFileName);
        }

        return new ConfigYaml($configFileName);
    }

    protected function initMysql()
    {
        $isDevMode = true;
        $proxyMode = DoctrineProxy::AUTOGENERATE_ALWAYS;
        $cache = new DoctrineCache\ArrayCache();

        $config = $this->di->get('config')->doctrine->mysql;

        $mappingDirs = $config->mappingDir->toArray();
        array_walk($mappingDirs, function (&$value, $key) {
            $value = PROJECT_PATH . $value;
        });

        $doctrineConfig = Setup::createYAMLMetadataConfiguration(
            $mappingDirs,
            $isDevMode,
            PROJECT_PATH . $config->proxyDir
        );

        $doctrineConfig->setProxyNamespace($config->proxyNamespace);
        $doctrineConfig->setAutoGenerateProxyClasses($proxyMode);
        $doctrineConfig->setMetadataCacheImpl($cache);
        $doctrineConfig->setQueryCacheImpl($cache);

        Autoloader::register(PROJECT_PATH . $config->proxyDir, $config->proxyNamespace);

        Type::addType('password', Password::class);
        Type::overrideType('datetime', UTCDateTimeType::class);
        Type::overrideType('datetimetz', UTCDateTimeType::class);

        $entityManager = EntityManager::create((array) $config->connections->default, $doctrineConfig);

        $this->di->setShared('em', $entityManager);
    }

    /**
     * Initializes the view and Volt
     *
     * @param array $options
     */
    protected function initView()
    {
        $di = $this->di;
        $config = $di->get('config');

        $di->setShared('view', function () use ($config, $di) {
            $view = new View();

            $view->setViewsDir(PROJECT_PATH . $config->volt->viewDir);
            $view->setLayoutsDir($config->volt->layoutDir);

            $view->setLayout($config->application->defaultLayoutName);

            $view->registerEngines(array(
                '.phtml' => '\Phalcon\Mvc\View\Engine\Php',
                '.volt' => function ($view, $di) use ($config) {
                    $volt = new Volt($view, $di);

                    $volt->setOptions(
                        array(
                            'compiledPath' => PROJECT_PATH . $config->volt->cacheDir,
                            'compiledSeparator' => '_',
                            'stat' => true,
                            'compileAlways' => true
                        )
                    );

                    $compiler = $volt->getCompiler();

                    // View functions
                    $functions = array();

                    foreach ($functions as $function) {
                        $compiler->addFunction(
                            $function['name'],
                            $function['method']
                        );
                    }

                    return $volt;
                }
            ));

            return $view;
        });
    }

    protected function initEnvironment()
    {
        $config = $this->getDI()->get('config');

        error_reporting(E_ALL ^ E_WARNING);

        ini_set('display_errors', $config->environment->displayErrors);
        ini_set('display_startup_errors', $config->environment->displayStartupErrors);

        setlocale(LC_ALL, 'es_ES.utf8');
        date_default_timezone_set('Europe/Madrid');
    }

    protected function initServices()
    {
        $di = $this->di;
        $this->getDI()->setShared('authenticationService', function() use($di) {
            $authenticationService = new AuthenticationService(
                $di->get('em')->getRepository(User::class)
            );
            return $authenticationService;
        });

        $this->getDI()->setShared('signupService', function() use($di) {
            $signupService = new SignupService(
                $di->get('em')->getRepository(User::class),
                $di->get('crewService'),
                $di->get('leaderBoardService'),
                $di->get('rankService')
            );
            return $signupService;
        });

        $this->getDI()->setShared('missionService', function() use($di) {
            $missionService = new MissionService(
                $di->get('em')->getRepository(Mission::class)
            );
            return $missionService;
        });

        $this->getDI()->setShared('userService', function() use($di) {
            $userService = new UserService(
                $di->get('em')->getRepository(User::class)
            );
            return $userService;
        });

        $this->getDI()->setShared('rewardService', function() use($di) {
            $rewardService = new RewardService(
                $di->get('em')->getRepository(Reward::class),
                $di->get('leaderBoardService'),
                $di->get('rankService'),
                $di->get('userService'),
                $di->get('missionService')
            );
            return $rewardService;
        });

        $this->getDI()->setShared('rankService', function() use($di) {
            $medalService = new RankService(
                $di->get('em')->getRepository(Medal::class),
                $di->get('em')->getRepository(Prize::class),
                $di->get('em')->getRepository(Rank::class),
                $di->get('em')->getRepository(EarnedMedal::class),
                $di->get('em')->getRepository(EarnedPrize::class),
                $di->get('userService')
            );
            return $medalService;
        });

        $this->getDI()->setShared('crewService', function() use($di) {
            $crewService = new CrewService(
                $di->get('em')->getRepository(Crew::class),
                $di->get('em')->getRepository(CrewMember::class),
                $di->get('userService')
            );
            return $crewService;
        });

        $this->getDI()->setShared('leaderBoardService', function() use($di) {
            $leaderBoardService = new LeaderBoardService(
                $di->get('em')->getRepository(LeaderBoard::class),
                $di->get('em')->getRepository(LeaderBoardPlayer::class),
                $di->get('userService')
            );
            return $leaderBoardService;
        });
    }
}
