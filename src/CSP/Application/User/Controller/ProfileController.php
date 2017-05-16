<?php

namespace CSP\Application\User\Controller;

use CSP\Application\Shared\Controller\SharedController;

class ProfileController extends SharedController
{
    public function editAction()
    {
        $this->view->user = $this->session->user;
    }

    public function saveAction()
    {
        if ($this->request->isPost()) {
            $user = $this->userService->findUserById($this->session->user->getId());

            $nickname = $this->request->getPost('nickname', 'string', null);
            $email = $this->request->getPost('email', 'email', null);

            $password = $this->request->getPost('password', 'string', null);
            $repassword = $this->request->getPost('repassword', 'string', null);

            if (($password == $repassword) && (!empty($password))) {
                $user->setPassword($password);
            }

            $user
                ->setNickname($nickname)
                ->setEmail($email);

            // Upload avatar
            if ($this->request->hasFiles() == true) {
                // Print the real file names and their sizes
                foreach ($this->request->getUploadedFiles() as $file) {
                    if ($file->getSize() > 0) {
                        $file->moveTo(PROJECT_PATH . '/public/uploads/avatars/dev/' . $file->getName());
                        $user->setAvatar($file->getName());
                    }

                    break;
                }
            }

            $this->userService->save($user);

            $this->session->set('user', $user);

            $this->flashSession->success('Usuari actualitzat correctament');
        }

        return $this->response->redirect('profile/edit');
    }

    /**
     * @todo
     */
    public function sharedAction()
    {

    }
}