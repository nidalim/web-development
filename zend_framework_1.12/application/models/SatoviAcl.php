<?php

class Model_SatoviAcl extends Zend_Acl{
    
    public function __construct() {
        $this->addRole(new Zend_Acl_Role('user'));
        $this->addRole(new Zend_Acl_Role('administrator'), 'user');
        
        $this->add(new Zend_Acl_Resource('index'));
        $this->add(new Zend_Acl_Resource('error'));
        $this->add(new Zend_Acl_Resource('contact'));
        $this->add(new Zend_Acl_Resource('auth'));
        $this->add(new Zend_Acl_Resource('edit'), 'index');
        $this->add(new Zend_Acl_Resource('add'), 'index');
        $this->add(new Zend_Acl_Resource('delete'), 'index');
        $this->add(new Zend_Acl_Resource('sign'), 'contact');
        
        
        
        
        $this->allow('user','index','index');
        $this->allow('user','contact');
        $this->allow('administrator','index', 'edit');
        $this->allow('administrator','index', 'add');
        $this->allow('administrator','index', 'delete');
        $this->allow('administrator','auth');
        $this->allow('user','auth');
    }
    
}