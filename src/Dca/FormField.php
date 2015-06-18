<?php

/**
 * @package    dev
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\Subforms\Dca;

/**
 * Form field data container helper class.
 *
 * @package Netzmacht\Contao\Subforms\Dca
 */
class FormField
{
    /**
     * Get all available forms.
     *
     * @param \DataContainer $dataContainer The data container driver.
     *
     * @return array
     */
    public function getSubformOptions($dataContainer)
    {
        $options    = array();
        $collection = \FormModel::findAll(['id !=?'], $dataContainer->id, ['order' => 'title']);

        if ($collection) {
            foreach ($collection as $form) {
                $options[$form->id] = sprintf('%s [%s]', $form->title, $form->id);
            }
        }

        return $options;
    }
}
