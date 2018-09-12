<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    protected function _initAutoLoad(){
        $modelLoader = new Zend_Application_Module_Autoloader(array(
            'namespace'=>'',
            'basePath'=>APPLICATION_PATH
        ));
        
        $acl = new Model_SatoviAcl;
        $auth = Zend_Auth::getInstance();
        
        $fc = Zend_Controller_Front::getInstance();
        $fc -> registerPlugin(new Plugin_AccessCheck($acl,$auth));
        
        return $modelLoader;
    }
    
    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');
    }

    protected function _initNavigation() {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');

        $navigation = new Zend_Navigation($config);
        $view->navigation($navigation);
    }
    
    
    
    

}

define('BASE_PATH', realpath(dirname(__FILE__) . '/..'));