<?php

namespace CSP\Application\Shared;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers the module auto-loader
     *
     * @param Phalcon\DI $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            array(
                'CSP\Application\Shared\Controller' => __DIR__ . '/Controller/'
            )
        );

        $loader->register();
    }

    /**
     * Registers the module-only services
     *
     * @param Phalcon\DI $di
     */
    public function registerServices(DiInterface $di)
    {
    }
}
