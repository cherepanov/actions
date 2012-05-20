<?php

class IndexController extends Zend_Controller_Action
{
    protected $actions = array(
        0 => array(
            'id' => 'drink',
            'css_class' => '',
            'title' => 'Drink it!',
            'vip' => false,
            'rest_time' => 0,
            'recovery_time' => 1,
        ),
        1 => array(
            'id' => 'beacon',
            'css_class' => '',
            'title' => 'Hungry?',
            'vip' => false,
            'rest_time' => 428,
            'recovery_time' => 2,
        ),
        2 => array(
            'id' => 'clock',
            'css_class' => '',
            'title' => 'Melt the clock!',
            'vip' => true,
            'rest_time' => 0,
            'recovery_time' => 5,
        ),
        3 => array(
            'id' => 'tornado',
            'css_class' => '',
            'title' => 'Make a vortex!',
            'vip' => true,
            'rest_time' => 0,
            'recovery_time' => 65,
        )
    );

    public function init()
    {
        /* Initialize action controller here */
    }

    function preDispatch()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_redirect('/auth/');
        }
    }

    public function indexAction()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $this->view->user = $auth->getIdentity();
        }
        $this->view->actions = $this->actions;
    }

}
