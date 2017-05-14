<?php

use CSP\CliBootstrap;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Phalcon\Config\Adapter\Yaml as PhConfig;
use Phalcon\DI\FactoryDefault\CLI as FactoryDefaultCli;

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', dirname(dirname(__FILE__)));
}

$config = new PhConfig(PROJECT_PATH . '/config/common.yml');

$environmentName = null;

foreach ($_SERVER['argv'] as $index => $arg) {
    $e = explode('=', $arg);
    $key = str_replace('-', '', $e[0]);

    if ('em' == $key) {
        $environmentName = $e[1];
        unset($_SERVER['argv'][$index]);
    }
}

$di = new FactoryDefaultCli();

$bootstrap = new CliBootstrap($di, $argv);

return ConsoleRunner::createHelperSet($bootstrap->getDI()->get('em'));
