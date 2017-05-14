<?php

namespace CSP\Application\User\Controller;

use CSP\Application\Shared\Controller\SharedController;
use CSP\Domain\User\Exception\UserAlreadyExistsException;

class SignupController extends SharedController
{
    public function indexAction()
    {
        $this
            ->addCustomJs('/assets-csp/plugins/jvalidate/jquery.validate.min.js')
            ->addCustomJs('/assets-csp/modules/user/scripts/signup.js')
            ->addCustomCss('/assets-csp/modules/user/css/sign.css');
    }

    public function signupAction()
    {
        $email = $this->request->getPost('email', 'string', null);
        $password = $this->request->getPost('password', 'string', null);

        try {
            $user = $this->signupService->signup($email, $password);

            $this->session->set('user', $user);

            $success = true;
            $message = 'Usuari registrat correctament';
        } catch (UserAlreadyExistsException $e) {
            $success = false;
            $message = 'Usuari ja registrat anteriorment';
        }

        $this->sendJson(
            $success,
            $message,
            array('url' => '/mission/index')
        );
    }
}
