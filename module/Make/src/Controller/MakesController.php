<?php
/**
 * @license © 2005 - 2016 by Zend Technologies Ltd. All rights reserved.
 */


namespace Make\Controller;

use Base\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Make\Form\MakesFilter;
use Make\Form\MakesForm;
use Make\Model\Makes\Makes;
use Make\Model\Makes\MakesRepository;

/**
 * SIGA-Smart
 *
 * Esta class foi gerada via Zend\Code\Generator.
 */
class MakesController extends AbstractController
{

    /**
     * __construct Factory Model
     *
     * @param ContainerInterface $containerInterface
     * @return \Make\Controller\MakesController
     */
    public function __construct(ContainerInterface $containerInterface)
    {
        // Configurações iniciais do Controller
        $this->containerInterface=$containerInterface;
        $this->table=MakesRepository::class;
        $this->model=Makes::class;
        $this->form=MakesForm::class;
        $this->filter=MakesFilter::class;
        $this->route="makes";
        $this->controller="makes";
        $this->template="make/make/listar";
    }


}

