<?php
namespace TwbBundle;

use TwbBundle\Form\View\Helper\Factory\TwbBundleFormElementFactory;
use TwbBundle\Form\View\Helper\TwbBundleForm;
use TwbBundle\Form\View\Helper\TwbBundleFormButton;
use TwbBundle\Form\View\Helper\TwbBundleFormCheckbox;
use TwbBundle\Form\View\Helper\TwbBundleFormCollection;
use TwbBundle\Form\View\Helper\TwbBundleFormElement;
use TwbBundle\Form\View\Helper\TwbBundleFormElementErrors;
use TwbBundle\Form\View\Helper\TwbBundleFormErrors;
use TwbBundle\Form\View\Helper\TwbBundleFormMultiCheckbox;
use TwbBundle\Form\View\Helper\TwbBundleFormRadio;
use TwbBundle\Form\View\Helper\TwbBundleFormRow;
use TwbBundle\Form\View\Helper\TwbBundleFormStatic;
use TwbBundle\View\Helper\TwbBundleAlert;
use TwbBundle\View\Helper\TwbBundleBadge;
use TwbBundle\View\Helper\TwbBundleButtonGroup;
use TwbBundle\View\Helper\TwbBundleDropDown;
use TwbBundle\View\Helper\TwbBundleFontAwesome;
use TwbBundle\View\Helper\TwbBundleGlyphicon;
use TwbBundle\View\Helper\TwbBundleLabel;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ConfigProviderInterface,ViewHelperProviderInterface{


    /**
     * @return array
     */
    public function getConfig(){
        return include __DIR__ .  '/../config/module.config.php';
    }


    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        // TODO: Implement getViewHelperConfig() method.
    }
}