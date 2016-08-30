<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Auth\Form;

use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class AuthForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @return \Auth\Form\AuthForm
     * @param ContainerInterface $containerInterface
     * @param string $name
     * @param array $options
     */
    public function __construct(ContainerInterface $containerInterface, $name = 'Users', array $options = array())
    {
        // Configurações iniciais do Form;
        parent::__construct($containerInterface, $name, $options);
        $this->setAttribute("action","/auth/authenticate");
        $this->setAttribute("id","Manager");
        $this->setInputFilter($containerInterface->get(AuthFilter::class));
        //############################################ informações da coluna email ##############################################:
        $this->add([
                'type' => 'text',//text,hidden, select, radio, checkbox, textarea
                'name' => 'email',
                'options' => [
                    'label' => 'FILD_EMAIL_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'EMAIL'],
                    'add-on-append'=>'envelope'
                ],
                'attributes' => [
                    'id'=>'email',
                    'class' =>'form-control',
                    'title' => 'FILD_EMAIL_LOGIN_DESC',
                    'placeholder' => 'FILD_EMAIL_LOGIN_PLACEHOLDER',
                   //'requerid' => true/false,
                    'data-access' => '3',
                    'data-position' => 'geral',
                ],
            ]
        );

      //############################################ informações da coluna password ##############################################:
        $this->add([
                'type' => 'password',//text,hidden, select, radio, checkbox, textarea
                'name' => 'password',
                'options' => [
                    'label' => 'FILD_PASSWORD_LOGIN_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'PASSWORD'],
                    'add-on-append'=>'aws-font'
                ],
                'attributes' => [
                    'id'=>'password',
                    'class' =>'form-control',
                    'title' => 'FILD_PASSWORD_LOGIN_DESC',
                    'placeholder' => 'FILD_PASSWORD_LOGIN_PLACEHOLDER',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                    'data-access' => '3',
                    'data-position' => 'geral',
                ],
            ]
        );
        $this->setCsrf([]);
        $this->setSave([ 'name' => 'logar',
            'type' => 'button',
            'attributes' => ['type' => 'submit','class'=>'btn btn-success'],
            'options' => [
                'label' => 'LOGAR NO SISTEMA',
                'column-size' => 'sm-12',
                'add-on-append'=>'floppy-o']]);
    }
}