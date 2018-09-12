<?php

class ContactController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
        $contact = new Application_Model_ContactMapper();
        $this->view->entries = $contact->fetchAll();
    }

    public function signAction() {
        // action body
        $request = $this->getRequest();
        $form = new Application_Form_Contact();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Contact($form->getValues());
                $mapper = new Application_Model_ContactMapper();
                $mapper->save($comment);
                return $this->_helper->redirector->gotoSimple('index', 'index');
            }
        }

        $this->view->form = $form;
    }

}
