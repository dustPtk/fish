<?php
namespace Admin\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class AddNoticeForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('text-content');

        $this->setAttribute('method', 'post');
        $this->add(array(
            'name' => 'notice_name',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'name'
            ),
        ));
        $this->add(array(
            'name' => 'notice_editor',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'editor'
            ),
        ));
        $this->add(array(
            'name' => 'notice_status',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'status'
            ),
        ));
        $this->add(array(
            'name' => 'notice_content',
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
