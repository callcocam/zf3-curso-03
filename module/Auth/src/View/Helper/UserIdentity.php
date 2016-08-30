<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 27/08/2016
 * Time: 22:35
 */

namespace Auth\View\Helper;


use Auth\Acl\Acl;
use Interop\Container\ContainerInterface;
use Zend\View\Helper\AbstractHelper;

class UserIdentity extends AbstractHelper {
    /**
     * @var Acl
     */
    protected $authAcl;
    protected $hasIdentity;
    public function getAuthAcl() {
        if ($this->authAcl) {
            return $this->authAcl;
        }
        else
            return false;
    }

    public function __construct(ContainerInterface $containerInterface) {
        $this->authAcl =$containerInterface->get(Acl::class);
        $this->hasIdentity=$this->authAcl->getIdentityManager()->hasIdentity();

    }

    /**
     * @return mixed
     */
    public function getHasIdentity()
    {
        return $this->hasIdentity;
    }

    public function IsAllowed($role,$Resource,$privilege){
        if($this->authAcl->hasResource($Resource) && !$this->authAcl->getIsAdmin($role)){
            return $this->authAcl->isAllowed($role, $Resource, $privilege);
        }
        else{
            return true;
        }

    }
} 