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
 * Form fields.
 */
$GLOBALS['TL_FFL']['subform'] = 'Netzmacht\Contao\Subforms\Form\SubformField';

/*
 * Hooks
 */
$GLOBALS['TL_HOOKS']['compileFormFields'][] = [
    'Netzmacht\Contao\Subforms\Observer\FormObserver',
    'hookCompileFormFields'
];

$GLOBALS['TL_HOOKS']['storeLeadsData'][] = [
    'Netzmacht\Contao\Subforms\Observer\LeadsObserver',
    'storeLeadsData'
];
