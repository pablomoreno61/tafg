<?php

require_once __DIR__ . '/../vendor/autoload.php';

use CSP\Bootstrap;
use Phalcon\DI\FactoryDefault;

date_default_timezone_set('UTC');

if (!defined('PROJECT_PATH')) {
    define('PROJECT_PATH', dirname(dirname(__FILE__)));
}

try {
	/**
	 * Handle the request
	 */
    $di = new FactoryDefault();
    $application = new Bootstrap($di);
    echo $application->run();

} catch (\Exception $e) {
	echo $e->getMessage();
} catch (PDOException $e){
	echo $e->getMessage();
}