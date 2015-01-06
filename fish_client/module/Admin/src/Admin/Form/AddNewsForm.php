<?php
namespace Admin\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class AddNewsForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('text-content');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'name',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'name'
            ),
        ));
        $this->add(array(
            'name' => 'editor',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'editor'
            ),
        ));
        $this->add(array(
            'name' => 'date',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'date'
            ),
        ));
        $this->add(array(
            'name' => 'status',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'status'
            ),
        ));
        $this->add(array(
        'name' => 'img',
        'type'  => 'text',
        'attributes' => array(
            'class' => 'span11',
            'placeholder' => 'img'
        ),
        ));
        $this->add(array(
            'name' => 'content',
            'type'  => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'How are you?'
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Submit',
                'class' => 'btn'
            ),
        ));
    }
}
