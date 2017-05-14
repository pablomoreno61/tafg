<?php

namespace CSP;

use CSP\Application\Security\Plugin\AclPlugin;
use Phalcon\Config\Adapter\Yaml as ConfigYaml;
use Phalcon\Config as PhConfig;
use Phalcon\DI\FactoryDefault;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Dispatcher as PhDispatcher;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Session\Adapter\Files as SessionAdapter;
use Phalcon\Text;

class Bootstrap extends AbstractBootstrap
{
    /**
     *
     * @param FactoryDefault $di
     */
    public function __construct(FactoryDefault $di)
    {
        $this->di = $di;

        $loaders = array(
            'config',
            'mysql',
            'environment',
            'router',
            'session',
            'url',
            'view',
            'dispatcher',
            'services'
        );

        foreach ($loaders as $service) {
            $function = 'init' . ucfirst($service);

            $this->$function();
        }
    }

    /**
     * Runs the application
     */
    public function run()
    {
        $application = new Application($this->di);

        $application->registerModules($this->getModules());

        return $application->handle()->getContent();
    }

    /**
     * Register application MVC modules
     */
    protected function getModules()
    {
        $config = $this->di->get('config');

        $absoluteModuleDir = PROJECT_PATH . $config->application->modulesDir;

        $loader = new Loader();
        $loader->registerNamespaces(array(
            'CSP\Application\Shared\Controller' => $absoluteModuleDir . '/Shared/Controller/'
        ));

        $loader->register();

        $frontendNames = array(
            'Finance',
            'Gamification',
            'Mission',
            'Shared',
            'User'
        );

        $frontendModules = array();
        foreach ($frontendNames as $module) {
            $frontendModules[strtolower($module)] = array(
                'className' => 'CSP\Application\\' . $module . '\Module',
                'path' => $absoluteModuleDir . '/' . $module . '/Module.php'
            );
        }

        return $frontendModules;
    }

    /**
     * Registering a router
     */
    protected function initRouter()
    {
        $routes = new ConfigYaml(PROJECT_PATH . '/config/routes.yml');

        $this->di->setShared('router', function () use ($routes) {
            $router = new Router(false);

            foreach ($routes as $route) {
                $urls = $route->url;

                if ($urls instanceof PhConfig) {
                    $urls = $route->url->toArray();
                } elseif (!is_array($urls)) {
                    $urls = array($urls);
                }

                foreach ($urls as $url) {
                    $routerItem = $router->add(
                        $url,
                        array(
                            'namespace' => $route->namespace,
                            'module' => $route->module,
                            'controller' => $route->controller,
                            'action' => $route->action
                        )
                    );

                    if (isset($route->camelize) && true == $route->camelize) {
                        $routerItem->convert('action', function ($action) {
                            return lcfirst(Text::camelize($action));
                        });
                    }
                }
            }
            $router->removeExtraSlashes(true);

            return $router;
        });
    }

    /**
     * Starts the session the first time some component requests the session service
     */
    protected function initSession()
    {
        $sessionConfig = $this->di->get('config')->session;
        $this->di->setShared('session', function () use ($sessionConfig) {
            $session = new SessionAdapter();
            $session->start();

            return $session;
        });
    }

    /**
     * The URL component is used to generate all kinds of URLs in the application
     */
    protected function initUrl()
    {
        $this->di->setShared('url', function () {
            $url = new UrlResolver();
            $url->setBaseUri('/');

            return $url;
        });
    }

    /**
     * Associate events to the Phalcon dispatcher
     */
    protected function initDispatcher()
    {
        $this->di->set('dispatcher', function () {
            $eventsManager = new EventsManager();

            $eventsManager->attach('dispatch:beforeExecuteRoute', new AclPlugin(), 100);

            $dispatcher = new PhDispatcher();
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        }, true);
    }
}
