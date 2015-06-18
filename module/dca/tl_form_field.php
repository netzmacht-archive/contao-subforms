<?php

/*
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_form_field']['palettes']['subform'] = '{type_legend},type;{fconfig_legend},subform';

/*
 * Legends
 */
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
    ),
    'options_callback' => array('Netzmacht\Contao\Subforms\Dca\FormField', 'getSubformOptions'),
    'sql'              => "int(10) unsigned NOT NULL default '0'"
);
