<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Auth\Controller;

use Auth\Form\ProfileFilter;
use Auth\Form\ProfileForm;
use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Auth\Model\Users\Users;
use Auth\Model\Users\UsersRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ProfileController extends AbstractController
{

    /**
     * __construct Factory Model
     *
     * @param ContainerInterface $containerInterface
     * @return \Auth\Controller\ProfileController
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        // Configurações iniciais do Controller
        $this->containerInterface=$containerInterface;
        $this->table=UsersRepository::class;
        $this->model=Users::class;
        $this->form=ProfileForm::class;
        $this->filter=ProfileFilter::class;
        $this->route="users";
        $this->controller="users";
    }

    public function updateprofileAction(){
        if(!$this->IdentityManager->hasIdentity()){
            $this->Messages()->flashError("AUTENTICAÇÃO FALHOU, VOCÊ NÃO TEM PERMISSÃO!");
            return $this->redirect()->toRoute($this->route);
        }
        $this->tplEditar="profile";
        if($this->getData()){
            return parent::finalizarAction();
        }
        $this->form=$this->getForm();
        $this->form->setData((array)$this->user);
        $view=$this->getView($this->data);
        $view->setVariable('form',$this->form);
        $view->setTemplate('/admin/admin/editar');
        return $view;
    }

}