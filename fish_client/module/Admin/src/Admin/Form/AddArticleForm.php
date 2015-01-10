<?php
namespace Admin\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class AddArticleForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('text-content');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'article_name',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'name'
            ),
        ));
        $this->add(array(
            'name' => 'article_editor',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'editor'
            ),
        ));
        $this->add(array(
            'name' => 'article_content',
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
