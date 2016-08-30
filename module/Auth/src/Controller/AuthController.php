<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 17/08/2016
 * Time: 00:57
 */

namespace Auth\Controller;


use Auth\Form\AuthFilter;
use Auth\Form\AuthForm;
use Auth\Form\ProfileFilter;
use Auth\Form\ProfileForm;
use Auth\Storage\Result;
use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Zend\Crypt\Key\Derivation\Pbkdf2;
use Zend\Debug\Debug;

class AuthController extends AbstractController {

    /**
     * @param ContainerInterface $containerInterface
     */
    function __construct(ContainerInterface $containerInterface)
    {
        $this->containerInterface=$containerInterface;
        $this->form=AuthForm::class;
        $this->filter=AuthFilter::class;
        $this->route="auth";
    }

    public function encryptPassword($login, $password) {
        return base64_encode(Pbkdf2::calc('sha256', $password, $login, 10000, strlen($this->config->staticsalt * 2)));
    }

    public function prepareData($data) {
        if (!empty($data['password'])):
            $this->data['password'] = $this->encryptPassword($data['email'], $data['password']);
            $this->data['usr_password_confirm'] = $this->encryptPassword($data['email'], $data['usr_password_confirm']);
            $this->data['usr_registration_token'] = md5(uniqid(mt_rand(), true));
        endif;
        return $this->data;
    }

    public function loginAction(){

        $this->template="/auth/auth/login";
        $this->form=$this->getForm();
        $view=$this->getView($this->data);
        $view->setVariable('form',$this->form);
        return $view;
    }

    /**
     * @return \Zend\Http\Response
     */
    public function authenticateAction()
    {
         if($this->IdentityManager->hasIdentity()){
            return $this->redirect()->toRoute($this->route,['action'=>'success']);
         }
        //PEGAR OS DADOS DO USUARIO PASSADO VIA POST
        $request = $this->params()->fromPost();
        //PEGAMOS O FORMULARIO
        $this->form = $this->getForm();
        //VERIFICA SE FOI PASSADO UM POST
        if ($request) {
            //CARREGAMOS O FORMULARIO COM SO DADO DO USUARIO
            $this->form->setData($request);
            //VERIFICA SE O FORMULARIO É VALIDO
            if ($this->form->isValid()) {
                //RECUPERA OS DADOS VALIDADOS DO FORMULARIO
                $dataform = $this->form->getData();
                //VERIFICA SE O USUARIO EXISTE
                $result = $this->getIdentityManager()->login(
                    $dataform['email'],
                    $this->encryptPassword($dataform['email'],$dataform['password']),
                    $this->getRequest()->getServer('HTTP_USER_AGENT'),
                    $this->getRequest()->getServer('REMOTE_ADDR'));
                   //CARREGA AS MENSSAGENS COM A CLASS RESULT
                    $messagesResult=new Result($result->getCode(),$result->getIdentity());
                   //SE VALIDO O USUARIO ENTRA AQUI
                if ($result->isValid()) {
                    //AUTHENTICADO COM SUCESSO
                    //$this->Messages()->flashSuccess($messagesResult->getMessage());
                    return $this->redirect()->toRoute($this->route,$this->config->routeSuccess);
                } else {
                    //AUTHENTICAÇÃO INVALIDA
                    $this->Messages()->flashError($messagesResult->getMessage());
                    return $this->redirect()->toRoute($this->route);
                 }
            }
            else{
                //RECARREGA O FORMULARIO
                $this->template="/auth/auth/login";
                $view=$this->getView([]);
                $view->setVariable('form',$this->form);
                $view->setTemplate($this->template);
                return $view;
            }
        }
        $this->Messages()->flashError("AUTENTICAÇÃO FALHOU, VOCÊ NÃO TEM PERMISSÃO!");
        return $this->redirect()->toRoute($this->route);
    }

    public function successAction(){

        $view=$this->getView($this->data);
        return $view;
    }

    public function logoutsuccessAction(){

        $view=$this->getView($this->data);
        return $view;
    }

    public function logoutAction()
    {
        if ($this->getIdentityManager()->hasIdentity()) {
            $this->getIdentityManager()->logout();
        }
        return $this->redirect()->toRoute($this->route,$this->config->routeLogout);
    }
}