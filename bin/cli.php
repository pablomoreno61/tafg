<?php

require_once __DIR__ . '/../vendor/autoload.php';

use CSP\CliBootstrap;
use Phalcon\DI\FactoryDefault\CLI as FactoryDefaultCli;

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', dirname(dirname(__FILE__)));
}

$di = new FactoryDefaultCli();

$bootstrap = new CliBootstrap($di, $argv);

$bootstrap->run();
