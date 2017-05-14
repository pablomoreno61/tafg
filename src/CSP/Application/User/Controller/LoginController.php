<?php

namespace CSP\Application\User\Controller;

use CSP\Application\Shared\Controller\SharedController;
use CSP\Domain\User\Exception\UserDoesNotExistsException;

class LoginController extends SharedController
{
    public function indexAction()
    {
        $this
            ->addCustomJs('/assets-csp/plugins/jvalidate/jquery.validate.min.js')
            ->addCustomJs('/assets-csp/modules/user/scripts/login.js')
            ->addCustomCss('/assets-csp/modules/user/css/sign.css');
    }

    public function loginAction()
    {
        $email = $this->request->getPost('email', 'string', null);
        $password = $this->request->getPost('password', 'string', null);

        try {
            $user = $this->authenticationService->login($email, $password);

            $this->session->set('user', $user);

            $success = true;
            $message = 'Sessió iniciada correctament';
        } catch (UserDoesNotExistsException $e) {
            $success = false;
            $message = 'L\'usuari no existeix';
        }

        $this->sendJson(
            $success,
            $message,
            array('url' => '/mission/index')
        );
    }

    public function logoutAction()
    {
        $this->session->destroy();

        $this->response->redirect('login');
    }
}
