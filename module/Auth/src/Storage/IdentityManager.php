<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 27/08/2016
 * Time: 10:22
 */

namespace Auth\Storage;


use Zend\Authentication\AuthenticationService;

class IdentityManager implements IdentityManagerInterface{
    /**
     * @var AuthenticationService
     */
    private $authenticationService;
    /**
     * @param AuthenticationService $authenticationService
     */
    public function __construct(AuthenticationService $authenticationService){

        $this->authenticationService = $authenticationService;
    }

    /**
     * @param $identity
     * @param $credential
     * @param $user_agent
     * @param $ip_address
     * @return \Zend\Authentication\Result
     */
    public function login($identity, $credential, $user_agent, $ip_address)
    {
        $this->getAuthService()->getAdapter()->setIdentity($identity)->setCredential($credential);
        $result = $this->getAuthService()->authenticate();
        if($result->isValid())
        {
            $user=$this->getAuthService()->getAdapter()->getResultRowObject();
            $user->ip_address = $ip_address;
            $user->user_agent = $user_agent;
            $this->storeIdentity($user);
        }
        return $result;
    }

    /**
     * Finaliza A Sessão Do Usuario
     */
    public function logout()
    {
        $this->getAuthService()->getStorage()->clear();
    }

    /**
     * @return O Usuario Logado
     */
    public function hasIdentity()
    {
       return $this->getAuthService()->getStorage()->read();
    }

    /**
     * Set Os Dados Do Usuario
     * @param $identity
     */
    public function storeIdentity($identity)
    {
        $this->getAuthService()->getStorage()->write($identity);
    }

    /**
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authenticationService;
    }
}