<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 31/07/2016
 * Time: 10:39
 */

namespace Make\Controller;


use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Make\Model\Makes\Makes;
use Make\Model\Makes\MakesRepository;
use Make\Services\Controller;
use Make\Services\ControllerFactory;
use Make\Services\FactoryFilter;
use Make\Services\FactoryForm;
use Make\Services\FactoryModel;
use Make\Services\Filter;
use Make\Services\Form;
use Make\Services\MakeNavigation;
use Make\Services\Model;
use Make\Services\Repository;
use Make\Services\RepositoryFactory;
use Zend\Debug\Debug;
use Zend\View\Model\ViewModel;

class MakeController extends AbstractController{

    /**
     * @param ContainerInterface $container
     */
    function __construct(ContainerInterface $container)
    {
        // TODO: Implement __construct() method.
        $this->containerInterface = $container;
        $this->template="admin/admin/index";
        $this->table=MakesRepository::class;
        $this->model=Makes::class;

    }
    public function gerarAction()
    {
      
        $module=$this->params()->fromRoute('id');
        $make=$this->getTable()->find($module,false);
         if($make->getData()){
            $data=$make->getData();
            $module=$data['parent'];
            $classe=$data['arquivo'];
            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Model"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Model"));
            }

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Form"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Form"));
            }

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Controller"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Controller"));
            }

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Model/{$classe}"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Model/{$classe}"));
            }
            $model=new Model($data,$this->containerInterface);
            $model->generateClass();
            $msg[]="Model {$classe} Foi Criado Com Sucesso!";

            /*Model Factory*/
            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Model/{$classe}/Factory"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Model/{$classe}/Factory"));
            }
            $modelFactory=new FactoryModel($data,$this->containerInterface);
            $modelFactory->generateClass();
            $msg[]="Model Factory {$classe} Foi Criado Com Sucesso!";


            $repository=new Repository($data,$this->containerInterface);
            $repository->generateClass();
            $msg[]="Repository {$classe} Foi Criado Com Sucesso!";

            $repositoryFactory=new RepositoryFactory($data,$this->containerInterface);
            $repositoryFactory->generateClass();
            $msg[]="Repository Factory {$classe} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Controller"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Controller"));
            }
            $controller=new Controller($data,$this->containerInterface);

            $controller->generateClass();
            $msg[]="Controller {$classe} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Controller/Factory"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Controller/Factory"));
            }
            $controllerFactory=new ControllerFactory($data,$this->containerInterface);
            $controllerFactory->generateClass();
            $msg[]="Controller Factory {$classe} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Form"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Form"));
            }
            $form=new Form($data,$this->containerInterface);
            $form->generateClass();
            $msg[]="Form {$classe} Foi Criado Com Sucesso!";

            if(!is_dir(sprintf("./{$this->config->module}/{$module}/src/Form/Factory"))){
                mkdir(sprintf("./{$this->config->module}/{$module}/src/Form/Factory"));
            }
            $formFactory=new FactoryForm($data,$this->containerInterface);
            $formFactory->generateClass();
            $msg[]="Form Factory {$classe} Foi Criado Com Sucesso!";

            $filter=new Filter($data,$this->containerInterface);
            $filter->generateClass();
            $msg[]="Filter {$classe} Foi Criado Com Sucesso!";

            $filterFactory=new FactoryFilter($data,$this->containerInterface);
            $filterFactory->generateClass();



            $msg[]=PHP_EOL;
            $msg[]="Você Pode Ainda Adicionar Os Uses No Arquivo module/{$module}/src/Module.php";
            $msg[]="use {$module}\Form\Factory\\{$classe}FilterFactory;";
            $msg[]="use {$module}\Form\Factory\\{$classe}FormFactory;";
            $msg[]="use {$module}\Form\\{$classe}Filter;";
            $msg[]="use {$module}\Form\\{$classe}Form;";
            $msg[]="use {$module}\Model\\{$classe}\Factory\\{$classe}Factory;";
            $msg[]="use {$module}\Model\\{$classe}\Factory\\{$classe}RepositoryFactory;";
            $msg[]="use {$module}\Model\\{$classe}\\{$classe};";
            $msg[]="use {$module}\Model\\{$classe}\\{$classe}Repository;";

            $msg[]=PHP_EOL;
            $msg[]="Filter Factory {$classe} Foi Criado Com Sucesso!";
            $msg[]="Você Pode Ainda Adicionar Os Serviços No Arquivo module/{$module}/Module.php";
            $msg[]="{$classe}::class=>{$classe}Factory::class,";
            $msg[]="{$classe}Repository::class=>{$classe}RepositoryFactory::class,";
            $msg[]="{$classe}Form::class=>{$classe}FormFactory::class,";
            $msg[]="{$classe}Filter::class=>{$classe}FilterFactory::class,";

            $msg[]=PHP_EOL;
            $msg[]="Você Pode Ainda Adicionar A Rota No Arquivo module/{$module}/config/module.config.php";
            $rota=$data['route'];
            $msg[]="'{$rota}' => [";
            $msg[]="    'type'    => Segment::class,";
            $msg[]="    'options' => [";
            $msg[]="        'route'    => '/{$rota}[/:action][/:id]',";
            $msg[]="        'defaults' => [";
            $msg[]="           'controller' => Controller\\{$classe}Controller::class,";
            $msg[]="            'action'     => 'index',";
            $msg[]="            'id'     => '0',";
            $msg[]="        ],";
            $msg[]="    ],";
            $msg[]="]";

            $msg[]=PHP_EOL;
            $msg[]="Você Pode Ainda Adicionar Os Serviços No Arquivo module/{$module}/config/module.config.php";
            $msg[]="{$classe}Controller::class=>{$classe}ControllerFactory::class,";

             $this->Messages()->flashSuccess(implode("<p>",$msg));
             return $this->redirect()->toRoute("makes");

        }
        return new ViewModel(['error'=>"Nenhum Parametro Valido Foi Passado, Você Deve Passar Um Model E Uma Tabela"]);
    }

    public function destroyAction()
    {
        $module=$this->params()->fromRoute('id');
        $make=$this->getTable()->find($module,false);

        if($make->getData()) {
            $data=$make->getData();
            $module=$data['parent'];
            $classe=$data['arquivo'];

            $msg[]=PHP_EOL;
            $msg[]="Você Pode Ainda Remover Os Uses No Arquivo module/{$module}/src/Module.php";
            $path=sprintf("./{$this->config->module}/{$module}/src/Model/{$classe}");
            if (PHP_OS === 'Windows')
            {
                exec("rd /s /q {$path}");
                $msg[]="use {$module}\Model\\{$classe}\Factory\\{$classe}Factory;";
                $msg[]="use {$module}\Model\\{$classe}\Factory\\{$classe}RepositoryFactory;";
                $msg[]="use {$module}\Model\\{$classe}\\{$classe};";
                $msg[]="use {$module}\Model\\{$classe}\\{$classe}Repository;";
            }
            else
            {
                exec("rm -rf {$path}");
                $msg[]="use {$module}\Model\\{$classe}\Factory\\{$classe}Factory;";
                $msg[]="use {$module}\Model\\{$classe}\Factory\\{$classe}RepositoryFactory;";
                $msg[]="use {$module}\Model\\{$classe}\\{$classe};";
                $msg[]="use {$module}\Model\\{$classe}\\{$classe}Repository;";
            }

            if(file_exists(sprintf("./{$this->config->module}/{$module}/src/Form/%sForm.php",$classe))){
                unlink(sprintf("./{$this->config->module}/{$module}/src/Form/%sForm.php",$classe));
                $msg[]="use {$module}\Form\\{$classe}Form;";
            }

            if(file_exists(sprintf("./{$this->config->module}/{$module}/src/Form/Factory/%sFormFactory.php",$classe))){
                unlink(sprintf("./{$this->config->module}/{$module}/src/Form/Factory/%sFormFactory.php",$classe));
                $msg[]="use {$module}\Form\Factory\\{$classe}FormFactory;";
            }

            if(file_exists(sprintf("./{$this->config->module}/{$module}/src/Form/%sFilter.php",$classe))){
                unlink(sprintf("./{$this->config->module}/{$module}/src/Form/%sFilter.php",$classe));
                $msg[]="use {$module}\Form\\{$classe}Filter;";
            }

            if(file_exists(sprintf("./{$this->config->module}/{$module}/src/Form/Factory/%sFilterFactory.php",$classe))){
                unlink(sprintf("./{$this->config->module}/{$module}/src/Form/Factory/%sFilterFactory.php",$classe));
                $msg[]="use {$module}\Form\Factory\\{$classe}FilterFactory;";
            }

            if(file_exists(sprintf("./{$this->config->module}/{$module}/src/Controller/%sController.php",$classe))){
                unlink(sprintf("./{$this->config->module}/{$module}/src/Controller/%sController.php",$classe));
                $msg[]=PHP_EOL;
                $msg[]="Você Pode Ainda Remover Os Serviços No Arquivo module/{$module}/config/module.config.php";
                $msg[]="{$classe}Controller::class=>{$classe}ControllerFactory::class,";
            }

            if(file_exists(sprintf("./{$this->config->module}/{$module}/src/Controller/Factory/%sControllerFactory.php",$classe))){
                unlink(sprintf("./{$this->config->module}/{$module}/src/Controller/Factory/%sControllerFactory.php",$classe));
            }
            $msg[]=PHP_EOL;
            $msg[]="Você Pode Ainda Remover Os Serviços No Arquivo module/{$module}/Module.php";
            $msg[]="{$classe}::class=>{$classe}Factory::class,";
            $msg[]="{$classe}Repository::class=>{$classe}RepositoryFactory::class,";
            $msg[]="{$classe}Form::class=>{$classe}FormFactory::class,";
            $msg[]="{$classe}Filter::class=>{$classe}FilterFactory::class,";

            $msg[]=PHP_EOL;
            $msg[]="Você Pode Ainda Remover A Rota No Arquivo module/{$module}/config/module.config.php";
            $rota=$data['route'];
            $msg[]="'{$rota}' => [";
            $msg[]="    'type'    => Segment::class,";
            $msg[]="    'options' => [";
            $msg[]="        'route'    => '/{$rota}[/:action][/:id]',";
            $msg[]="        'defaults' => [";
            $msg[]="           'controller' => Controller\\{$classe}Controller::class,";
            $msg[]="            'action'     => 'index',";
            $msg[]="            'id'     => '0',";
            $msg[]="        ],";
            $msg[]="    ],";
            $msg[]="]";

            $this->Messages()->flashError(implode("<p>",$msg));
            return $this->redirect()->toRoute("makes");

        }
        return new ViewModel(['error'=>"Nenhum Parametro Valido Foi Passado, Você Deve Passar Um Model E Uma Tabela"]);
    }

    /**
     * Gera A Nevegação Do Sistema
     */
    public function navigationAction(){

        $navigatio=new MakeNavigation($this->containerInterface,"special");
        $navigatio->generate('./config/autoload/special.php');
        $this->Messages()->flashSuccess("NAVEGAÇÃO ATUALIZADA COM SUCESSO!");
        return $this->redirect()->toRoute("makes");

    }


}