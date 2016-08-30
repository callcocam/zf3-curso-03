<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 17/08/2016
 * Time: 00:14
 */

namespace Base\Controller;


use Auth\Storage\IdentityManager;
use Base\Model\AbstractModel;
use Interop\Container\ContainerInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

abstract class AbstractController extends AbstractActionController {

    /**
     * @var $containerInterface ContainerInterface
     */
    protected $containerInterface;
    /**
    * @var $IdentityManager IdentityManager
    */
    protected $IdentityManager;
    protected $table;
    protected $model;
    protected $form;
    protected $filter;
    protected $user;
    protected $route;
    protected $template='/admin/admin/listar';
    protected $controller;
    protected $action;
    protected $id;
    protected $page;
    protected $data;
    protected $filtro=[];
    protected $config;
    protected $tplEditar="inserir";

    /**
     * @param MvcEvent $e
     * @return mixed
     */
    public function onDispatch(MvcEvent $e)
    {
        $this->getIdentityManager();
        $this->config=$this->containerInterface->get('ZfConfig');
        if(!$this->IsAllowed($e)){
            return $this->redirect()->toRoute('access-deny');
        }
        return parent::onDispatch($e);
    }

    /**
     * @param ContainerInterface $containerInterface
     */
    abstract  function __construct(ContainerInterface $containerInterface);

    /**
     * @return mixed
     */
    public function getTable()
    {
        return $this->containerInterface->get($this->table);
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->containerInterface->get($this->model);
    }

    /**
     * @return mixed
     */
    public function getForm($form="")
    {
        if(empty($form)):
            $this->form=$this->containerInterface->get($this->form);
        else:
            $this->form=$this->containerInterface->get($form);
        endif;
        return $this->form;
    }

    /**
     * @return mixed
     */
    public function getFilter($filter="")
    {
        if(empty($filter)):
            $this->filter=$this->containerInterface->get($this->filter);
        else:
            $this->filter=$this->containerInterface->get($filter);
        endif;
        return $this->filter;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        $request=$this->getRequest();
        if(!$request->isPost()):
            return [];
        endif;
        $this->data=array_merge_recursive($request->getPost()->toArray(),
            $request->getFiles()->toArray());
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getIdentityManager()
    {
        $this->IdentityManager=$this->containerInterface->get(IdentityManager::class);
        $this->user=$this->IdentityManager->hasIdentity();
        return $this->IdentityManager;
    }


    public function indexAction()
    {
        if(!$this->IdentityManager->hasIdentity()){
            $this->Messages()->flashInfo("ACESSO NEGADO, POR FAVOR FAÇA OGIN DE USUARIO");
            return $this->redirect()->toRoute($this->config->routeAuthenticate);
        }
        $this->page=$this->params()->fromRoute('page','1');
        if($this->table):
            $this->filtro=$this->getData();
            $this->filtro['asset_id']=$this->controller;
            $this->data=$this->getTable()->select($this->filtro,$this->page);
            $this->data=$this->data->toArray();
        endif;
        $view=$this->getView($this->data);
        $view->setTemplate($this->template);
        return $view;
    }

    public function createAction()
    {
        if(!$this->IdentityManager->hasIdentity()){
            $this->Messages()->flashInfo("ACESSO NEGADO, POR FAVOR FAÇA OGIN DE USUARIO");
            return $this->redirect()->toRoute($this->config->routeAuthenticate);
        }
        $this->form=$this->getForm();
        $view=$this->getView($this->data);
        $view->setVariable('form',$this->form);
        $view->setTemplate('/admin/admin/editar');
        return $view;
    }

    public function updateAction()
    {
        if(!$this->IdentityManager->hasIdentity()){
            $this->Messages()->flashInfo("ACESSO NEGADO, POR FAVOR FAÇA OGIN DE USUARIO");
            return $this->redirect()->toRoute($this->config->routeAuthenticate);
        }
        $id=$this->params()->fromRoute('id','0');
        if(!(int)$id){
            return $this->redirect()->toRoute($this->route);
        }
        $this->getTable()->find($id,false);
        if(!$this->getTable()->getData()->getResult()){
            return $this->redirect()->toRoute($this->route);
        }
        $this->form=$this->getForm();
        $this->form->setData($this->getTable()->getData()->getData());
        $view=$this->getView($this->data);
        $view->setVariable('form',$this->form);
        $view->setTemplate('/admin/admin/editar');
        return $view;
    }

    public function deleteAction()
    {
        if(!$this->IdentityManager->hasIdentity()){
            $this->Messages()->flashInfo("ACESSO NEGADO, POR FAVOR FAÇA OGIN DE USUARIO");
            return $this->redirect()->toRoute($this->config->routeAuthenticate);
        }
        $id=$this->params()->fromRoute('id','0');
        if(!(int)$id){
            $this->Messages()->flashError("VOCÊ DEVE PASAR UM CODIGO VALIDO!");
            return $this->redirect()->toRoute($this->route);
        }
        $this->getTable()->find($id,false);
        if(!$this->getTable()->getData()->getResult()){
            $this->Messages()->flashError("O REGISTRO {$id} NÃO FOI ENCONTRADO!");
        return $this->redirect()->toRoute($this->route);
        }
        $this->getTable()->delete($id);
        if($this->getTable()->getData()->getResult()){
            $this->Messages()->flashSuccess("O REGISTRO {$id} FOI EXCLUIDO COM SUCESSO!");
        }
        return $this->redirect()->toRoute($this->route);
    }

    /**
     * @return JsonModel
     */
    public function finalizarAction()
    {
        $this->form=$this->getForm();
         $tempFile = null;
        if($this->getData()){
            $tempFile = null;
                   if(isset($this->data['atachament'])){
                    if(is_array($this->data['atachament'])){
                        $fileName=$this->setFileName($this->data['atachament']['name']);
                        $this->data['atachament']['name']=$fileName;
                        $this->data['images']=$this->CheckFolder($fileName);
                    }
                }

            /**
             * @var $mode AbstractModel
             */
                $model=$this->getModel();
                $model->exchangeArray($this->data);
                $this->form->setData($this->data);
                $this->data['model']=$model->toArray();
                if ($this->form->isValid()) {
                   if((int)$this->data['id']){
                        $this->getTable()->update($model);
                   }
                    else{
                        $model->setEmpresa($this->user->empresa);
                        $model->setAssetId($this->controller);
                        $this->getTable()->insert($model);
                    }
                    $view=new JsonModel($this->getTable()->getData()->toArray());
                    return $view;
                }
                else
                {
                   $error=[];
                    foreach ($this->form->getMessages() as $key=> $messages){
                        foreach($messages as  $ms){
                            $error[$key]=sprintf("[%s-%s]",$key,$ms);
                        }
                    }
                    $this->data['err']=$error;
                    $this->data['error']=implode(PHP_EOL,$error);
                }

        }
        $view=new JsonModel($this->data);
        return $view;
    }

    public function getView($data){
        $view=new ViewModel($data);
        $view->setVariable('controller',$this->controller);
        $view->setVariable('route',$this->route);
        $view->setVariable('page',$this->page);
        $view->setVariable('tplEditar',$this->tplEditar);
        $view->setVariable('page',$this->page);
        $view->setVariable('filtro',$this->filtro);
        return $view;
    }

    //Verifica e monta o nome dos arquivos tratando a string!
    public function setFileName($Name) {
        $FileName = $this->setName(substr($Name, 0, strrpos($Name, '.')));
        $FileName =strtolower($FileName) . strrchr($Name, '.');
        return $FileName;
    }
    //Verifica e cria os diretórios com base em tipo de arquivo, ano e mês!
    //Verifica e cria os diretórios com base em tipo de arquivo, ano e mês!
    public function CheckFolder($fileName,$Folder="images") {
        $ds=DIRECTORY_SEPARATOR;
        list($y, $m) = explode('/', date('Y/m'));
        $basePath = "{$Folder}{$ds}{$y}{$ds}{$m}{$ds}";
        return sprintf("%s%s",$basePath,$fileName);
    }
    //Verifica e cria o diretório base!
    public function CreateFolder($Folder) {
        if (!file_exists($Folder) && !is_dir($Folder)):
            mkdir($Folder, 0777);
        endif;
    }
    /**
     * <b>Tranforma Nome:</b> Retira acentos e caracteres especias!
     * @param STRING $Name = Uma string qualquer
     * @return STRING um nome tratado
     */
    public function setName($Name) {
        $var = strtolower(utf8_encode($Name));
        return preg_replace('{\W}', '', preg_replace('{ +}', '_', strtr(
            utf8_decode(html_entity_decode($var)), utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'), 'AAAAEEIOOOUUCNaaaaeeiooouucn')));
    }

} 