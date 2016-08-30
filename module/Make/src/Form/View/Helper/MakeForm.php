<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 18/08/2016
 * Time: 22:45
 */

namespace Make\Form\View\Helper;


use Base\Form\AbstractForm;
use Zend\Form\View\Helper\Form;


class MakeForm extends Form{

    /**
     * @var string
     */
    const LAYOUT_HORIZONTAL = 'horizontal';

    /**
     * @var string
     */
    const LAYOUT_INLINE = 'inline';

    /**
     * @var string
     */
    const LAYOUT_DEFAULT = '';

    /**
     * @var string
     */
    private static $formRowFormat = ['inline'=>null,'horizontal'=>null];

    /**
     * Form layout (see LAYOUT_* consts)
     *
     * @var string
     */
    protected $formLayout = null;

    /**
     * Layout Html Do Form
     * @var array
     */
    protected $layout=[];
    /**
     * Carrega os Campos Da Tabela
    * @var array
    */
    protected $fields=[];
    /**
     * CArrega As Labes
    * @var array
     */
    protected $labes=[];
    /**
     * Monta O Bloco Geral
    * @var array
     */
    protected $geral=[];
    protected $datas=[];
    protected $controle=[];
    protected $btn=[];


    /**
     * @see Form::__invoke()
     * @param AbstractForm $oForm
     * @param string $sFormLayout
     * @return TwbBundleForm|string
     */
    public function gerar(AbstractForm $oForm = null, $sFormLayout = self::LAYOUT_HORIZONTAL)
    {

        self::$formRowFormat[self::LAYOUT_INLINE]=$this->view->Html('div','%s',['class'=>'row']);

        self::$formRowFormat[self::LAYOUT_HORIZONTAL]=$this->view->Html('div','%s',['class'=>'']);

        self::$formRowFormat[self::LAYOUT_DEFAULT]=$this->view->Html('div','%s',['class'=>'form-group']);
        if ($oForm) {
            return $this->render($oForm, $sFormLayout);
        }
        $this->formLayout = $sFormLayout;
        return $this;
    }

    /**
     * Render a form from the provided $oForm,
     * @see Form::render()
     * @param AbstractForm $oForm
     * @param string $sFormLayout
     * @return string
     */
    public function render(AbstractForm $oForm= null, $sFormLayout = self::LAYOUT_DEFAULT)
    {

        //Prepare form if needed
        if (method_exists($oForm, 'prepare')) {
            $oForm->prepare();
        }
        $this->setFormClass($oForm, $sFormLayout);
        //Set form role
        if (!$oForm->getAttribute('role')) {
            $oForm->setAttribute('role', 'form');
        }
        if (!$oForm->getAttribute('action')) {
            $oForm->setAttribute('action', $this->view->url($this->view->route,['controller'=>$this->view->controller,'action'=>'finalizar']));
        }
        $this->renderElements($oForm, $sFormLayout);
        return implode(PHP_EOL,$this->layout);
    }

    public function renderElements($oForm, $sFormLayout){
        foreach ($oForm as $key => $element):
            $visible = "";
            $access=1;
            //verifica se o usuario pode ter acesso ao campo
            if ($element->hasAttribute('data-access')) {
                if(isset($this->view->user->role_id)){
                    $access=$this->view->user->role_id;
                }
                $visible = $access <= $element->getAttribute('data-access') ? "" : " disabled";
              }

            if($element->getAttribute('type')=="hidden"){
                $visible="disabled";
            }
            if($sFormLayout==self::LAYOUT_INLINE){
                $labelBox=$this->view->Html('label',PHP_EOL,['class'=>"control-label col-md-4 col-sm-3 col-xs-12",'for'=>"{$key}"])->appendText("{{{$key}}}")->appendText(PHP_EOL);
                $rowBox=$this->view->Html('div',PHP_EOL,['class'=>'col-md-8 col-sm-9 col-xs-12'])->appendText("#{$key}#")->appendText(PHP_EOL);
            }
            elseif($sFormLayout==self::LAYOUT_DEFAULT){
                $labelBox=$this->view->Html('label',PHP_EOL,['class'=>'control-label','for'=>$key])->appendText("{{{$key}}}")->appendText(PHP_EOL);
                $rowBox=$this->view->Html('div',PHP_EOL,['class'=>"ola"])->appendText("#{$key}#")->appendText(PHP_EOL);
            }
            else
            {
                $labelBox=$this->view->Html('label',PHP_EOL,['class'=>'control-label','for'=>$key])->appendText("{{{$key}}}")->appendText(PHP_EOL);
                $rowBox=$this->view->Html('div',PHP_EOL,['class'=>"valid {$key}"])->appendText("#{$key}#")->appendText(PHP_EOL);
            }


            if ($element->hasAttribute('placeholder')) {
                $element->setAttribute('placeholder', $this->view->translate($element->getAttribute('placeholder')));
            }


            if($this->view->resolver(sprintf("/partial/tpl/%s",$element->getAttribute('type')))){
                $partial=$this->view->partial(sprintf("/partial/tpl/%s",$element->getAttribute('type')));
            }
            else{
                $partial=$this->view->partial("/partial/tpl/text");
            }
            if(!empty($visible)){
                $this->layout[$key]="#$key#";
                $this->fields["#{$key}#"]=$this->view->formHidden($element);
            }
            elseif($element->getAttribute('type')=="button" || $element->getAttribute('type')=="submit"){
                if(!empty($element->getOption('add-on-append'))){
                    $element->setOption('add-on-append',$this->view->fontAwesome($element->getOption('add-on-append')));
                }
                $this->layout[$key]="";
                $this->btn["#{$key}#"]=$this->view->TwbformButton($element);
            }
            elseif($element->getAttribute('name')=="created" || $element->getAttribute('name')=="modified"){
                $row=sprintf($partial,$labelBox,$rowBox,$this->view->TwbformElementErrors($element));
                $this->layout[$key]=sprintf(self::$formRowFormat[$sFormLayout],$row,$key);
                $element->setOption('add-on-append',$this->view->glyphicon('calendar'));
                $this->labes["{{{$key}}}"]=$this->view->translate($element->getLabel());
                $this->fields["#{$key}#"]=$this->view->TwbformElement($element);
            }
            elseif($element->getAttribute('type')=="file"){
                $row=sprintf($partial,$labelBox,$rowBox,$this->view->TwbformElementErrors($element));
                $this->layout[$key]=sprintf(self::$formRowFormat[$sFormLayout],$row);
                $element->setOption('add-on-append',$this->view->glyphicon('picture'));
                $element->setOption('add-on-prepend',"Selec. Image");
                $element->setAttribute('type','text');
                $this->labes["{{{$key}}}"]=$this->view->translate($element->getLabel());
                $this->fields["#{$key}#"]=$this->view->TwbformElement($element);
                $root = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
                $info = new \SplFileInfo(sprintf("%s/dist/%s",$root,$element->getValue()));
                if($this->isFileHidden($info)){
                    $this->fields["#imagePriview#"]=$this->view->Html('img',PHP_EOL,['src'=>sprintf("/dist/%s",$element->getValue()),'style'=>'width:100%;height:250px;','id'=>'img-preview']);
                }
                else{
                    $this->fields["#imagePriview#"]=$this->view->Html('img',PHP_EOL,['src'=>'/dist/no_image.jpg','style'=>'width:100%;height:250px;','id'=>'img-preview']);
                }
            }
            else{
                if(!empty($element->getOption('add-on-append'))){
                    $element->setOption('add-on-append',$this->view->fontAwesome($element->getOption('add-on-append')));
                }
                $row=sprintf($partial,$labelBox,$rowBox,$this->view->TwbformElementErrors($element));
                $this->layout[$key]=sprintf(self::$formRowFormat[$sFormLayout],$row);
                $this->labes["{{{$key}}}"]=$this->view->translate($element->getLabel());
                $this->fields["#{$key}#"]=$this->view->TwbformElement($element);
            }

            if($oForm->get($key)->getAttribute('data-position')=="datas"){
                $this->datas[$key]=$this->layout[$key];
            }
            elseif($oForm->get($key)->getAttribute('data-position')=="controller"){
                $this->controle[$key]=$this->layout[$key];
            }
            else{
                $this->geral[$key]=$this->layout[$key];
            }
        endforeach;
        $this->layout["btn-voltar"]="";
        $this->btn["#btn-voltar#"]=$this->view->Html('a',"VOLTAR",['class'=>'btn btn-danger','href'=>$this->view->url($this->view->route)])->appendText($this->view->glyphicon('share-alt'));
        $this->geral["btn-voltar"]=$this->layout["btn-voltar"];

    }

    /**
     * Sets form layout class
     * @param AbstractForm $oForm
     * @param string $sFormLayout
     * @return \TwbBundle\Form\View\Helper\TwbBundleForm
     */
    protected function setFormClass(AbstractForm $oForm, $sFormLayout = self::LAYOUT_HORIZONTAL)
    {
        if (is_string($sFormLayout)) {
            $sLayoutClass = 'form-' . $sFormLayout;
            if ($sFormClass = $oForm->getAttribute('class')) {
                if (!preg_match('/(\s|^)' . preg_quote($sLayoutClass, '/') . '(\s|$)/', $sFormClass)) {
                    $oForm->setAttribute('class', trim($sFormClass . ' ' . $sLayoutClass));
                }
            } else {
                $oForm->setAttribute('class', $sLayoutClass);
            }
        }
        return $this;
    }

    /**
     * Generate an opening form tag
     * @param null|AbstractForm $form
     * @return string
     */
    public function openTag(AbstractForm $form = null)
    {
        $this->setFormClass($form, $this->formLayout);
        return parent::openTag($form);
    }

    public function closeTag()
    {
        return parent::closeTag();
    }


    /**
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @return array
     */
    public function getLabes()
    {
        return $this->labes;
    }

     /**
     * @return array
     */
    public function getControle()
    {
        return $this->controle;
    }

    /**
     * @return array
     */
    public function getDatas()
    {
        return $this->datas;
    }

    /**
     * @return array
     */
    public function getGeral()
    {
        return $this->geral;
    }

    /**
     * @return array
     */
    public function getBtn()
    {
        return $this->btn;
    }

     /**
     * @param \SplFileInfo $file
     * @return bool
     */
    public function isFileHidden(\SplFileInfo $file) {
        $basename = $file->getBasename();
        return strpos($basename, '.') > 0;
    }


} 