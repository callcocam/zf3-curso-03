<?php
namespace TwbBundle;
return [
    'twbbundle' => [
        'ignoredViewHelpers' => [
            'file',
            'checkbox',
            'radio',
            'submit',
            'multi_checkbox',
            'static',
            'button',
            'reset'
        ],
        'type_map' => [],
        'class_map' => [],
    ],
    'service_manager' => [
        'factories' => [
            'TwbBundle\Options\ModuleOptions' => 'TwbBundle\Options\Factory\ModuleOptionsFactory'
        ]
    ],
    'view_helpers' => [
        'invokables' => [
            //Alert
            'alert' => 'TwbBundle\View\Helper\TwbBundleAlert',
            //Badge
            'badge' => 'TwbBundle\View\Helper\TwbBundleBadge',
            //Button group
            'buttonGroup' => 'TwbBundle\View\Helper\TwbBundleButtonGroup',
            //DropDown
            'dropDown' => 'TwbBundle\View\Helper\TwbBundleDropDown',
            //Form
            'form' => 'TwbBundle\Form\View\Helper\TwbBundleForm',
            'TwbformButton' => 'TwbBundle\Form\View\Helper\TwbBundleFormButton',
            'TwbformSubmit' => 'TwbBundle\Form\View\Helper\TwbBundleFormButton',
            'TwbformCheckbox' => 'TwbBundle\Form\View\Helper\TwbBundleFormCheckbox',
            'TwbformCollection' => 'TwbBundle\Form\View\Helper\TwbBundleFormCollection',
            'TwbformElementErrors' => 'TwbBundle\Form\View\Helper\TwbBundleFormElementErrors',
            'formMultiCheckbox' => 'TwbBundle\Form\View\Helper\TwbBundleFormMultiCheckbox',
            'TwbformRadio' => 'TwbBundle\Form\View\Helper\TwbBundleFormRadio',
            'TwbformRow' => 'TwbBundle\Form\View\Helper\TwbBundleFormRow',
            'formStatic' => 'TwbBundle\Form\View\Helper\TwbBundleFormStatic',
            //Form Errors
            'formErrors' => 'TwbBundle\Form\View\Helper\TwbBundleFormErrors',
            //Glyphicon
            'glyphicon' => 'TwbBundle\View\Helper\TwbBundleGlyphicon',
            //FontAwesome
            'fontAwesome' => 'TwbBundle\View\Helper\TwbBundleFontAwesome',
            //Label
            'label' => 'TwbBundle\View\Helper\TwbBundleLabel'
        ],
        'factories' => [
            'TwbformElement' => 'TwbBundle\Form\View\Helper\Factory\TwbBundleFormElementFactory',
        ]
    ],

];
