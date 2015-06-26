<?php

/**
 * @package    contao-subforms
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

/*
 * Config
 */
$GLOBALS['TL_DCA']['tl_form_field']['config']['onload_callback'][] = [
    'Netzmacht\Contao\Subforms\Dca\FormField',
    'preparePalette'
];

/*
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['subform'] = '{type_legend},type,subform;{subform_legend},subformLeadStore';

/*
 * Fields
 */
$GLOBALS['TL_DCA']['tl_form_field']['fields']['type']['eval']['tl_class'] = 'w50';
$GLOBALS['TL_DCA']['tl_form_field']['fields']['type']['save_callback'][]  = [
    'Netzmacht\Contao\Subforms\Dca\FormField',
    'storeType'
];

$GLOBALS['TL_DCA']['tl_form_field']['fields']['subform'] = array(
    'label'            => &$GLOBALS['TL_LANG']['tl_form_field']['subform'],
    'exclude'          => true,
    'inputType'        => 'select',
    'filter'           => true,
    'sorting'          => true,
    'eval'             => array(
        'mandatory'          => true,
        'tl_class'           => 'w50',
        'includeBlankOption' => true,
        'chosen'             => true,
        'submitOnChange'     => true
    ),
    'options_callback' => array('Netzmacht\Contao\Subforms\Dca\FormField', 'getSubformOptions'),
    'sql'              => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['subformLeadStore'] = array(
    'label'            => &$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStore'],
    'exclude'          => true,
    'inputType'        => 'multiColumnWizard',
    'filter'           => true,
    'sorting'          => true,
    'eval'             => array(
        'tl_class'     => 'clr',
        'columnFields' => array(
            'field' => array(
                'label'            => &$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStoreField'],
                'exclude'          => true,
                'inputType'        => 'select',
                'filter'           => true,
                'sorting'          => true,
                'eval'             => array(
                    'tl_class'           => 'w50',
                    'style'              => 'width: 203px',
                    'includeBlankOption' => true,
                    'chosen'             => true,
                ),
                'options_callback' => array('Netzmacht\Contao\Subforms\Dca\FormField', 'getSubformFields'),
                'sql'              => "int(10) unsigned NOT NULL default '0'"
            ),
            'leadStore' => array(
                'label'            => &$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStoreLeadStore'],
                'exclude'          => true,
                'inputType'        => 'select',
                'filter'           => true,
                'sorting'          => true,
                'eval'             => array(
                    'tl_class'           => 'w50',
                    'style'              => 'width: 203px',
                    'includeBlankOption' => true,
                    'chosen'             => true,
                ),
                'options_callback' => array('tl_form_field_leads', 'getLeadStoreOptions'),
                'sql'              => "int(10) unsigned NOT NULL default '0'"
            ),
        ),
    ),
    'sql'              => "blob NULL"
);

