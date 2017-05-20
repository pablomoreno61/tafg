<?php

namespace CSP\Application\Gamification\Controller;

use CSP\Application\Shared\Controller\SharedController;
use CSP\Domain\Gamification\Entity\Crew;

class CrewController extends SharedController
{
    /**
     * @todo
     */
    public function editAction()
    {
        $crew = $this->crewService->findCrewByUser($this->session->user->getId());

        if (!$crew) {
            $crew = new Crew();
        }

        $this->view->crew = $crew;
    }

    public function saveAction()
    {
        if ($this->request->isPost()) {
            $text = $this->request->getPost('text', 'string', null);

            $logo = null;
            if ($this->request->hasFiles() == true) {
                foreach ($this->request->getUploadedFiles() as $file) {
                    if ($file->getSize() > 0) {
                        $logo = $file;
                    }

                    break;
                }
            }

            $this->crewService->save(
                $this->session->user->getId(),
                $text,
                $logo
            );

            $this->flashSession->success('Tripulació actualitzada correctament');
        }

        return $this->response->redirect('crew/edit');
    }

    /**
     * @todo
     */
    public function showAction()
    {
        $crew = $this->crewService->findCrewByUser($this->session->user->getId());

        $this->view->crewMembers = array();
        if ($crew) {
            $this->view->crewMembers = $this->crewService->findCrewMembers($crew->getId());
        }

        $this->view->crew = $crew;
    }

    /**
     * @todo
     */
    public function removeMemberAction()
    {

    }
}