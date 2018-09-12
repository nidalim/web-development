<?php

class Application_Form_Contact extends Zend_Form {

    public function init() {
        $this->setMethod('post');

        // Add an email element
        $this->addElement('text', 'email', array(
            'label' => 'Unesite email adresu:',
            'required' => true,
            'filters' => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            )
        ));

        // Add the comment element
        $this->addElement('textarea', 'comment', array(
            'label' => 'Ostavite komentar:',
            'required' => true,
            'validators' => array(
                array('validator' => 'StringLength', 'options' => array(0, 20))
            )
        ));

        // Add a captcha
        $this->addElement('captcha', 'captcha', array(
            'label' => 'Molimo vas da unesete slova prikazana ispod:',
            'required' => true,
            'captcha' => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore' => true,
            'label' => 'Kontakt',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }

}
