<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        $contact = new Application_Model_ContactMapper();
        $this->view->entries = $contact->fetchAll();

        $satovi = new Application_Model_DbTable_Satovi();
        $this->view->satovi = $satovi->fetchAll();
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
                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }

    public function addAction() {
        $form = new Application_Form_Satovi();
        $form->submit->setLabel('Dodaj');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $model = $form->getValue('model');
                $brend = $form->getValue('brend');
                $slika = $form->getValue('slika');
                $cena = $form->getValue('cena');
                $opis = $form->getValue('opis');
                $satovi = new Application_Model_DbTable_Satovi();
                $satovi->addSatovi($model, $brend, $slika, $cena, $opis);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function editAction() {
        $form = new Application_Form_Satovi();
        $form->submit->setLabel('Sačuvaj');
        $this->view->form = $form;
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int) $form->getValue('id');
                $model = $form->getValue('model');
                $brend = $form->getValue('brend');
                $slika = $form->getValue('slika');
                $cena = $form->getValue('cena');
                $opis = $form->getValue('opis');
                $satovi = new Application_Model_DbTable_Satovi();
                $satovi->updateSatovi($id, $model, $brend, $slika, $cena, $opis);
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $satovi = new Application_Model_DbTable_Satovi();
                $form->populate($satovi->getSatovi($id));
            }
        }
    }

    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Da') {
                $id = $this->getRequest()->getPost('id');
                $satovi = new Application_Model_DbTable_Satovi();
                $satovi->deleteSatovi($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $satovi = new Application_Model_DbTable_Satovi();
            $this->view->satovi = $satovi->getSatovi($id);
        }
    }
    

}
