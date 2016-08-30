<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 25/08/2016
 * Time: 09:34
 */

namespace Make\View\Helper;


use Interop\Container\ContainerInterface;
use Zend\View\Helper\AbstractHelper;

class TplListaHelper extends AbstractHelper {
    /**
     * @var ContainerInterface
     */
    private $containerInterface;


    /**
     * @param ContainerInterface $containerInterface
     */
    function __construct(ContainerInterface $containerInterface)
    {
        $this->containerInterface = $containerInterface;
    }

    public function geraListagem($data){
        $partial=$this->view->partial("/partial/tpl/index");
        $render=[];

        return $partial;

    }

}