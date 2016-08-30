<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Admin\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Admin\Form\ConfiguracaoFilter;
use Admin\Form\ConfiguracaoForm;
use Admin\Model\Configuracao\Configuracao;
use Admin\Model\Configuracao\ConfiguracaoRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ConfiguracaoController extends AbstractController
{

    /**
     * __construct Factory Model
     *
     * @param ContainerInterface $containerInterface
     * @return \Admin\Controller\ConfiguracaoController
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        // Configurações iniciais do Controller
        $this->containerInterface=$containerInterface;
        $this->table=ConfiguracaoRepository::class;
        $this->model=Configuracao::class;
        $this->form=ConfiguracaoForm::class;
        $this->filter=ConfiguracaoFilter::class;
        $this->route="configuracao";
        $this->controller="configuracao";
    }


}

