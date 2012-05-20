<?php
class Zend_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract
{
    public function loggedInAs ()
    {
        $result = '';
        $auth = Zend_Auth::getInstance();
        $request = Zend_Controller_Front::getInstance()->getRequest();
        $controller = $request->getControllerName();
        $action = $request->getActionName();

        if ($auth->hasIdentity()) {
            $identity = $auth->getIdentity();
            $logoutUrl = $this->view->url(array('controller'=>'auth', 'action'=>'logout'), null, true);
            $result = 'Welcome, <b>' . $identity['username'] .  '</b>. <a href="'.$logoutUrl.'">Logout</a>';
        } else if($controller == 'auth' && $action == 'index') {
            //return '';
        } else {
            $loginUrl = $this->view->url(array('controller'=>'auth', 'action'=>'index'));
            $result = '<a href="'.$loginUrl.'">Login</a>';
        }

        return $result;
    }
}