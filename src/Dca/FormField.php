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
     * Prepare the palette.
     *
     * @return void
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function preparePalette()
    {
        $leadForm = $GLOBALS['objLeadForm'];

        $GLOBALS['TL_DCA']['tl_form_field']['palettes']['subform'] = str_replace(
            ',leadStore',
            '',
            $GLOBALS['TL_DCA']['tl_form_field']['palettes']['subform']
        );

        if (!$this->isLeadsExtensionActive() || !$leadForm || !$leadForm->leadEnabled) {
            unset($GLOBALS['TL_DCA']['tl_form_field']['fields']['subformLeadStore']);
        } elseif ($leadForm && $leadForm->leadEnabled && $leadForm->leadMaster == 0) {
            $dca = &$GLOBALS['TL_DCA']['tl_form_field']['fields']['subformLeadStore']['eval']['columnFields'];

            $dca['leadStore']['options']                  = ['1' => $GLOBALS['TL_LANG']['MSC']['yes']];
            $dca['leadStore']['eval']['blankOptionLabel'] = $GLOBALS['TL_LANG']['MSC']['no'];

            unset($dca['leadStore']['options_callback']);
        }
    }

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

    /**
     * Get sub form fields.
     *
     * @param \DataContainer $dataContainer The data container.
     *
     * @return array
     */
    public function getSubformFields($dataContainer)
    {
        $options = array();

        if ($dataContainer->activeRecord) {
            $fields = \FormFieldModel::findBy(
                ['pid=?'],
                $dataContainer->activeRecord->subform,
                ['order' => 'label']
            );

            if ($fields) {
                foreach ($fields as $field) {
                    $options[$field->id] = $field->label ?: $fields->name;
                }
            }
        }

        return $options;
    }

    /**
     * Adjust leadStore option when saving a subform.
     *
     * @param mixed          $value         The given type value.
     * @param \DataContainer $dataContainer The data container driver.
     *
     * @return mixed
     */
    public function storeType($value, $dataContainer)
    {
        // Disable lead store option for subforms to prevent auto handling.
        if ($value === 'subform' && $this->isLeadsExtensionActive()) {
            \Database::getInstance()
                ->prepare('UPDATE tl_form_field %s where id=?')
                ->set(['leadStore' => ''])
                ->execute($dataContainer->id);

            $dataContainer->activeRecord->leadStore = '';
        }

        return $value;
    }

    /**
     * Check if leads extension is installed and activated.
     *
     * @return bool
     */
    private function isLeadsExtensionActive()
    {
        return in_array('leads', \ModuleLoader::getActive());
    }
}
