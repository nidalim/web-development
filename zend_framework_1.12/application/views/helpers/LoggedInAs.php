<?php

class Zend_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract
{
public function loggedInAs ()
{
$auth = Zend_Auth::getInstance();
if ($auth->hasIdentity()) {
$username = $auth->getIdentity()->username;
$logoutUrl = $this->view->url(array('controller'=>'auth',
'action'=>'logout'), null, true);
return $logoutUrl;
}

$request = Zend_Controller_Front::getInstance()->getRequest();
$controller = $request->getControllerName();
$action = $request->getActionName();
if($controller == 'auth' && $action == 'index') {
return '';
}
$loginUrl = $this->view->url(array('controller'=>'auth', 'action'=>'index'));
return $loginUrl;
}
}

class Zend_View_Helper_LoggedInAsName extends Zend_View_Helper_Abstract
{
public function loggedInAsName ()
{
$auth = Zend_Auth::getInstance();
if ($auth->hasIdentity()) {
$username = $auth->getIdentity()->username;
$logoutUrl = $this->view->url(array('controller'=>'auth',
'action'=>'logout'), null, true);
return 'Logout';
}

$request = Zend_Controller_Front::getInstance()->getRequest();
$controller = $request->getControllerName();
$action = $request->getActionName();
if($controller == 'auth' && $action == 'index') {
return '';
}
$loginUrl = $this->view->url(array('controller'=>'auth', 'action'=>'index'));
return 'Login';
}
}



