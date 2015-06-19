<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

/*
 * Form fields
 */
$GLOBALS['TL_LANG']['FFL']['subform'][0] = 'Subform';
$GLOBALS['TL_LANG']['FFL']['subform'][1] = 'Include fields of a defined sub form.';

/*
 * Legends
 */
$GLOBALS['TL_LANG']['tl_form_field']['subform_legend'] = 'Subform configuration';

/*
 * Fields
 */
$GLOBALS['TL_LANG']['tl_form_field']['subform'][0]                   = 'Subform';
$GLOBALS['TL_LANG']['tl_form_field']['subform'][1]                   = 'Please select a form to include its fields into the form.';
$GLOBALS['TL_LANG']['tl_form_field']['subformPrefix'][0]             = 'Prefix fields';
$GLOBALS['TL_LANG']['tl_form_field']['subformPrefix'][1]             = 'If enabled each field of the subform get prefixed with the defined fieldname.';
$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStore'][0]          = 'Lead store';
$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStore'][1]          = 'Please select form fields which should be included in the lead.';
$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStoreField'][0]     = 'Field';
$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStoreField'][1]     = 'Please select the fields which should be stored in the lead.';
$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStoreLeadStore'][0] = 'Save in leads';
$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStoreLeadStore'][1] = 'Select if/where the field value should be saved. For slave forms, you must select the matching master form field.';
$GLOBALS['TL_LANG']['tl_form_field']['subformLeadStoreLeadStore'][2] = 'Do not save';
