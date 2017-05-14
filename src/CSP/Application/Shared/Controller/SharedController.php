<?php

namespace CSP\Application\Shared\Controller;

use Phalcon\Mvc\Controller as PhController;

class SharedController extends PhController
{
    protected function addCustomJs($filePath)
    {
        $this->assets->addJs($filePath);

        return $this;
    }

    protected function addCustomCss($filePath)
    {
        $this->assets->addCss($filePath);

        return $this;
    }

    protected function setHeadTitle($headTitle)
    {
        if (strpos($headTitle, 'TFG Consupermiso') === false) {
            $headTitle .= ' | TFG Consupermiso';
        }

        Tag::setDefault('headTitle', $headTitle);

        return $this;
    }

    protected function sendJson(bool $success, $message, array $data)
    {
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');

        $response = array(
            'success' => $success,
            'message' => $message,
            'data' => $data
        );

        $this->response->setContent(json_encode($response));
        $this->response->send();
    }
}
