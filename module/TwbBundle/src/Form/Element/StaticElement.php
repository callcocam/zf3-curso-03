<?php
namespace TwbBundle\Form\Element;
use Zend\Form\Element;

class StaticElement extends Element{
    /**
     * Seed attributes
     * @var array
     */
    protected $attributes = array(
        'type' => 'static'
    );
}