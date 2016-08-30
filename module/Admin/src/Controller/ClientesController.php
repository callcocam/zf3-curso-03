<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Admin\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Admin\Form\ClientesFilter;
use Admin\Form\ClientesForm;
use Admin\Model\Clientes\Clientes;
use Admin\Model\Clientes\ClientesRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class ClientesController extends AbstractController
{

    /**
     * __construct Factory Model
     *
     * @return __construct
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        // Configurações iniciais do Controller
        $this->containerInterface=$containerInterface;
        $this->table=ClientesRepository::class;
        $this->model=Clientes::class;
        $this->form=ClientesForm::class;
        $this->filter=ClientesFilter::class;
        $this->route="clientes";
        $this->controller="clientes";
    }


}

