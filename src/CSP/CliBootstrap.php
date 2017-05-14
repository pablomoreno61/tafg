<?php

namespace CSP;

use Phalcon\CLI\Console;
use Phalcon\DI\FactoryDefault\CLI as FactoryDefaultCli;
use Phalcon\Exception;

class CliBootstrap extends AbstractBootstrap
{
    private $arguments;

    /**
     * CliBootstrap constructor.
     * @param FactoryDefaultCli $di
     * @param array $arguments
     */
    public function __construct(FactoryDefaultCli $di, array $arguments = array())
    {
        $this->di = $di;

        // Process the console arguments
        $this->arguments = $this->processArguments($arguments);

        $loaders = array(
            'config',
            'mysql',
            'environment',
            'services'
        );

        try {
            foreach ($loaders as $service) {
                $function = 'init' . ucfirst($service);

                $this->$function();
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Runs the application
     */
    public function run()
    {
        // Create a console application
        $console = new Console();
        $console->setDI($this->di);

        // Define global constants for the current task and action
        define('CURRENT_TASK', (isset($this->arguments['task']) ? $this->arguments['task'] : null));
        define('CURRENT_ACTION', (isset($this->arguments['action']) ? $this->arguments['action'] : null));

        try {
            // Handle incoming arguments
            $console->handle($this->arguments);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit(255);
        }
    }

    private function processArguments(array $arguments)
    {
        $parsedArguments = array();

        foreach ($arguments as $type => $value) {
            if (1 == $type) {
                $_SERVER['APPLICATION_ENV'] = $value;
            } elseif (2 == $type) {
                $namespaceTask = $value;

                $namespaceValues = explode('/', $namespaceTask);

                if (count($namespaceValues) > 1) {
                    $namespaceTask = '';
                    foreach ($namespaceValues as $depthIndex => $namespaceValue) {
                        if ($depthIndex === 1) {
                            $namespaceTask .= '\\Task\\';
                        }

                        $namespaceTask .= ucfirst($namespaceValue);
                    }

                    // $namespaceTask = substr_replace($namespaceTask, '', -1, 1);
                } elseif (count($namespaceValues) === 1) {
                    $namespaceTask .= '\\Task\\';
                }

                $parsedArguments['task'] = 'CSP\\Infrastructure\\' . $namespaceTask;
            } elseif (3 == $type) {
                $parsedArguments['action'] = $value;
            } elseif (4 <= $type) {
                $parsedArguments['params'][] = $value;
            }
        }

        return $parsedArguments;
    }
}
