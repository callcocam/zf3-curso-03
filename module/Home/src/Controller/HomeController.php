<?php
/**
 * Created by PhpStorm.
 * User: Call
 * Date: 16/08/2016
 * Time: 23:50
 */

namespace Home\Controller;


use Interop\Container\ContainerInterface;

class HomeController extends AbstractController {

    /**
     * @param ContainerInterface $containerInterface
     */
    function __construct(ContainerInterface $containerInterface)
    {
        $this->containerInterface=$containerInterface;
    }
}