<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\Subforms\Observer;

/**
 * The form observer combines the fields of a form and the subforms.
 *
 * @package Netzmacht\Contao\Subforms\Observer
 */
class FormObserver
{
    /**
     * Observe the compileFormFields hook and parse the fields.
     *
     * @param \FormFieldModel[] $fields The form fields.
     * @param int               $formId The form id.
     *
     * @return array
     */
    public function hookCompileFormFields($fields, $formId)
    {
        $combinedFields = array();

        $this->prepareFields($fields, $combinedFields, [$formId]);

        return $combinedFields;
    }

    /**
     * Prepare a set of fields.
     *
     * @param \FormFieldModel[] $fields         The given set of fields being prepared.
     * @param \FormFieldModel[] $combinedFields The prepared list of form fields.
     * @param array             $formStack      A stack of form ids to protect against recursion.
     *
     * @return void
     */
    private function prepareFields($fields, &$combinedFields, $formStack)
    {
        foreach ($fields as $field) {
            if ($field->type === 'subform') {
                $subformFields = \FormFieldModel::findPublishedByPid($field->subform);

                if ($subformFields && !in_array($field->subform, $formStack)) {
                    $newStack   = $formStack;
                    $newStack[] = $field->subform;

                    $this->prepareFields($subformFields, $combinedFields, $newStack);
                }

                continue;
            }

            $combinedFields[] = $field;
        }
    }
}
