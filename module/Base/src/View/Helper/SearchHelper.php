<?php
/**
 * Created by PhpStorm.
 * User: claudio
 * Date: 28/08/2016
 * Time: 23:51
 */

namespace Base\View\Helper;


use Base\Form\BuscaForm;
use Interop\Container\ContainerInterface;
use TwbBundle\Form\View\Helper\TwbBundleForm;
use Zend\View\Helper\AbstractHelper;


class SearchHelper extends AbstractHelper{

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

    /**
     * @param array $filtro
     */
    public function search($filtro=[]){
        /**
         * @var $form BuscaForm
         */
        $form=$this->containerInterface->get(BuscaForm::class);
        $form->setData($filtro);
        echo $this->view->form($form, null,TwbBundleForm::LAYOUT_HORIZONTAL);


    }
} 