<?php

class BackendController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    function preDispatch()
    {
        if (!$this->_request->isXmlHttpRequest()) {
            return;
        }
    }

    public function indexAction()
    {
        $response = $this->_request->getParams();
        $this->_helper->viewRenderer->setNoRender();
        if ($this->_request->getParam('id') === 'drink') {
            $response['action'] = 'addStar';
        }
        $this->_helper->json($response);
    }


}

