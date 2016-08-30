<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Auth\Form;

use Base\Form\AbstractForm;
use Interop\Container\ContainerInterface;
use Auth\Form\ResourcesFilter;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ResourcesForm extends AbstractForm
{

    /**
     * construct do Table
     *
     * @return  \Auth\Form\ResourcesForm
     * @param ContainerInterface $containerInterface
     * @param string $name
     * @param array $options
     */
    public function __construct(ContainerInterface $containerInterface, $name = 'Resources', array $options = array())
    {
        // Configurações iniciais do Form;
        parent::__construct($containerInterface, $name, $options);
        $this->setAttribute("id","Manager");
        $this->setInputFilter($containerInterface->get(ResourcesFilter::class));
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


        //############################################ informações da coluna alias ##############################################:
        $this->add([
                'type' => 'select',//hidden, select, radio, checkbox, textarea
                'name' => 'alias',
                'options' => [
                    'label' => 'FILD_ALIAS_LABEL',
                    'value_options'      =>[],
                    'disable_inarray_validator' => true,
                    //'label_attributes'=>['class'=>'control-label','for'=>'ALIAS'],
                    //'add-on-append'=>'aws-font'
                ],
                'attributes' => [
                    'id'=>'alias',
                    'class' =>'form-control',
                    'title' => 'FILD_ALIAS_DESC',
                    'placeholder' => 'FILD_ALIAS_PLACEHOLDER',
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
        $this->setModified(["type" => "hidden"]);
        $this->setCsrf([]);
        $this->setSave([]);

        if ($this->has('alias')):
            if($this->get('alias')->getAttribute('type')=="select"):
                $Resource=[''=>'--SELECIONE-'];
                $controllers = $this->containerInterface->get('Config');
                foreach($controllers['controllers']['factories'] as $key=> $value){
                    $Resource[$key]=$key;
                    //$Resource[strtolower(str_replace("\\", "_", $key))]=$key;
                }
                $this->get('alias')->setOptions(['value_options' => $Resource]);
            else:
                $this->get('alias')->setValue('Admin\Controller\AdminController');
            endif;
        endif;
    }
}