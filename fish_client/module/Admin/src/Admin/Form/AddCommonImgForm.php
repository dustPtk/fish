<?php
namespace Admin\Form;

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class AddCommonImgForm extends Form  implements InputFilterProviderInterface
{
    public function __construct($name = null)
    {
        parent::__construct('text-content');

        $this->setAttribute('method', 'post');

        $this->add(array(
            'name' => 'img_name',
            'type'  => 'text',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'name'
            ),
        ));
        $this->add(array(
            'name' => 'img',
            'type'  => 'Zend\Form\Element\File',
            'attributes' => array(
                'class' => 'span11',
            ),
        ));
        $this->add(array(
            'name' => 'img_intro',
            'type'  => 'Zend\Form\Element\Textarea',
            'attributes' => array(
                'class' => 'span11',
                'placeholder' => 'the food introduce?'
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


    public function getInputFilterSpecification()
    {
        return array(
            'image' => array(
                'required' => true,
            )
        );
    }
}
