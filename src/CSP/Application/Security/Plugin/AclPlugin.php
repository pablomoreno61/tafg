<?php

namespace CSP\Application\Security\Plugin;

use Phalcon\Acl;
use Phalcon\Acl\Adapter\Memory as AclAdapter;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Role;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Plugin;

/**
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class AclPlugin extends Plugin
{
    /**
     * This action is executed before execute any action in the application
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $acl = $this->buildAcl();

        $resource = $dispatcher->getModuleName() . '\\' . $dispatcher->getControllerName();
        $access = $dispatcher->getActionName();

        $roleName = 'guest';
        if ($this->session->has('user')) {
            $roleName = 'user';
        }

        $allowed = $acl->isAllowed($roleName, $resource, $access);

        if (!$allowed) {
            $this->response->redirect('/login');
            $this->response->setStatusCode(303);
            $this->response->send();
            exit;
        }
    }

    public function buildAcl()
    {
        $acl = new AclAdapter();
        $acl->setDefaultAction(
            Acl::DENY
        );

        $roles = array('guest', 'user');

        foreach ($roles as $roleName) {
            $acl->addRole(new Role($roleName));
        }

        // Private area resources (logged access)
        $privateResources = array(
            'finance\reward' => array('addUserReward', 'showUserBalance'),
            'gamification\crew' => array('edit', 'show'),
            'gamification\leaderBoard' => array('showPlayers'),
            'gamification\medal' => array('showEarnedMedals'),
            'mission\mission' => array('index'),
            'user\login' => array('logout'),
            'user\profile' => array('edit')
        );

        foreach ($privateResources as $resourceName => $actions) {
            $acl->addResource(
                new Resource($resourceName),
                $actions
            );
        }

        // Public area resources (anonymous access)
        $publicResources = array(
            'user\login' => array('index', 'login'),
            'user\signup' => array('index', 'signup'),
            'user\profile' => array('shared')
        );

        foreach ($publicResources as $resourceName => $actions) {
            $acl->addResource(
                new Resource($resourceName),
                $actions
            );
        }

        // Grant access to public areas to both users and guests
        foreach ($roles as $roleName) {
            foreach ($publicResources as $resource => $actions) {
                $acl->allow(
                    $roleName,
                    $resource,
                    "*"
                );
            }
        }

        // Grant access to private area only to role Users
        foreach ($privateResources as $resource => $actions) {
            foreach ($actions as $action) {
                $acl->allow(
                    'user',
                    $resource,
                    $action
                );
            }
        }

        return $acl;
    }
}
