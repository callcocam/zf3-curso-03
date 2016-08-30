<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;



use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class AdminController extends AbstractController
{

    /**
     * @param ContainerInterface $containerInterface
     */
    function __construct(ContainerInterface $containerInterface)
    {
       $this->containerInterface=$containerInterface;
       $this->template="/admin/admin/index";
    }
}
