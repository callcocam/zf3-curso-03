<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Admin\Form;

use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;
use Admin\Form\ConfiguracaoFilter;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ConfiguracaoForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @return  \Admin\Form\ConfiguracaoForm
     * @param ContainerInterface $containerInterface
     * @param string $name
     * @param array $options
     */
    public function __construct(ContainerInterface $containerInterface, $name = 'Configuracao', array $options = array())
    {
        // Configurações iniciais do Form;
        parent::__construct($containerInterface, $name, $options);
        $this->setAttribute("id","Manager");
        $this->setInputFilter($containerInterface->get(ConfiguracaoFilter::class));
        $this->setId([]);
        $this->setAssetid([]);
        $this->setCodigo([]);
        $this->setEmpresa([]);
        //############################################ informações da coluna title ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'title',
                'options' => [
                    'label' => 'FILD_TITLE_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'TITLE'],
                    //'add-on-append'=>'aws-font'
                ],
                'attributes' => [
                    'id'=>'title',
                    'class' =>'form-control',
                    'title' => 'FILD_TITLE_DESC',
                    'placeholder' => 'FILD_TITLE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna email ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
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
                    'title' => 'FILD_EMAIL_DESC',
                    'placeholder' => 'FILD_EMAIL_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna facebook ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'facebook',
                'options' => [
                    'label' => 'FILD_FACEBOOK_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'FACEBOOK'],
                    'add-on-append'=>'facebook'
                ],
                'attributes' => [
                    'id'=>'facebook',
                    'class' =>'form-control',
                    'title' => 'FILD_FACEBOOK_DESC',
                    'placeholder' => 'FILD_FACEBOOK_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna twitter ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'twitter',
                'options' => [
                    'label' => 'FILD_TWITTER_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'TWITTER'],
                    'add-on-append'=>'twitter'
                ],
                'attributes' => [
                    'id'=>'twitter',
                    'class' =>'form-control',
                    'title' => 'FILD_TWITTER_DESC',
                    'placeholder' => 'FILD_TWITTER_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna phone ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'phone',
                'options' => [
                    'label' => 'FILD_PHONE_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'PHONE'],
                    'add-on-append'=>'phone'
                ],
                'attributes' => [
                    'id'=>'phone',
                    'class' =>'form-control',
                    'title' => 'FILD_PHONE_DESC',
                    'placeholder' => 'FILD_PHONE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna endereco ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'endereco',
                'options' => [
                    'label' => 'FILD_ENDERECO_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'ENDERECO'],
                    //'add-on-append'=>'aws-font'
                ],
                'attributes' => [
                    'id'=>'endereco',
                    'class' =>'form-control',
                    'title' => 'FILD_ENDERECO_DESC',
                    'placeholder' => 'FILD_ENDERECO_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna bairro ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'bairro',
                'options' => [
                    'label' => 'FILD_BAIRRO_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'BAIRRO'],
                    //'add-on-append'=>'aws-font'
                ],
                'attributes' => [
                    'id'=>'bairro',
                    'class' =>'form-control',
                    'title' => 'FILD_BAIRRO_DESC',
                    'placeholder' => 'FILD_BAIRRO_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna fantasia ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'fantasia',
                'options' => [
                    'label' => 'FILD_FANTASIA_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'FANTASIA'],
                    //'add-on-append'=>'aws-font'
                ],
                'attributes' => [
                    'id'=>'fantasia',
                    'class' =>'form-control',
                    'title' => 'FILD_FANTASIA_DESC',
                    'placeholder' => 'FILD_FANTASIA_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna cidade ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'cidade',
                'options' => [
                    'label' => 'FILD_CIDADE_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'CIDADE'],
                    //'add-on-append'=>'aws-font'
                ],
                'attributes' => [
                    'id'=>'cidade',
                    'class' =>'form-control',
                    'title' => 'FILD_CIDADE_DESC',
                    'placeholder' => 'FILD_CIDADE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );





        //############################################ informações da coluna longetude ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'longetude',
                'options' => [
                    'label' => 'FILD_LONGETUDE_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'LONGETUDE'],
                    //'add-on-append'=>'aws-font'
                ],
                'attributes' => [
                    'id'=>'longetude',
                    'class' =>'form-control',
                    'title' => 'FILD_LONGETUDE_DESC',
                    'placeholder' => 'FILD_LONGETUDE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        //############################################ informações da coluna latitude ##############################################:
        $this->add([
                'type' => 'text',//hidden, select, radio, checkbox, textarea
                'name' => 'latitude',
                'options' => [
                    'label' => 'FILD_LATITUDE_LABEL',
                    //'value_options'      =>[],
                    //'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'LATITUDE'],
                    //'add-on-append'=>'aws-font'
                ],
                'attributes' => [
                    'id'=>'latitude',
                    'class' =>'form-control',
                    'title' => 'FILD_LATITUDE_DESC',
                    'placeholder' => 'FILD_LATITUDE_PLACEHOLDER',
                    'data-access' => '3',
                    'data-position' => 'geral',
                    //'readonly' => true/false,
                    //'requerid' => true/false,
                ],
            ]
        );


        $this->setDescription([]);
        $this->setAccess([]);
        $this->setState([]);
        $this->setCreated([]);
        $this->setModified([]);
        $this->setAtachament([]);
        $this->setCsrf([]);
        $this->setSave([]);
    }


}