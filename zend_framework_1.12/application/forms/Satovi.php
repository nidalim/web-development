<?php
class Application_Form_Satovi extends Zend_Form {

    public function init() {
        $this->setName('satovi');
        $this->setAttrib('enctype', 'multipart/form-data');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $brend = new Zend_Form_Element_Text('brend');
        $brend->setLabel('Brend')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $model = new Zend_Form_Element_Text('model');
        $model->setLabel('Model')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
                $cena = new Zend_Form_Element_Text('cena');
        $cena->setLabel('Cena')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
                $opis = new Zend_Form_Element_Textarea('opis');
        $opis->setLabel('Opis')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $slika = new Zend_Form_Element_File('slika');
        $slika->setLabel('Slika')
                //->setDestination(APPLICATION_PATH . '/uploads')
                ->setDestination(BASE_PATH . '/public/img')
                ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $this->addElements(array($id, $brend, $model, $slika, $cena, $opis, $submit));
    }

}
