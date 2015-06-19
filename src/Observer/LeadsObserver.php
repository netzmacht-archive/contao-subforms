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

use Model\Collection;

/**
 * Class LeadsObserver handles subforms field data.
 *
 * @package Netzmacht\Contao\Subforms\Observer
 */
class LeadsObserver
{
    /**
     * The submitted form data being processed.
     *
     * @var array
     */
    private $postData;

    /**
     * The form config.
     *
     * @var array
     */
    private $form;

    /**
     * The uploaded files.
     *
     * @var array
     */
    private $files;

    /**
     * The lead id.
     *
     * @var int
     */
    private $leadId;

    /**
     * Store the subform field data as lead data.
     *
     * @param array $postData The submitted data.
     * @param array $form     The form config.
     * @param array $files    The uploaded files.
     * @param int   $leadId   The created lead.
     *
     * @return void
     */
    public function storeLeadsData($postData, $form, $files, $leadId)
    {
        $fields = \FormFieldModel::findBy(
            ['type=?', 'pid=?', 'invisible=?'],
            ['subform', $form['id'], ''],
            ['order' => 'sorting']
        );

        if ($fields) {
            $this->postData = $postData;
            $this->form     = $form;
            $this->files    = $files;
            $this->leadId   = $leadId;

            foreach ($fields as $field) {
                $this->storeSubform($field);
            }
        }
    }

    /**
     * Store the data of the subform.
     *
     * @param \FormFieldModel $subformField The subform field.
     *
     * @return void
     */
    private function storeSubform($subformField)
    {
        $fields = deserialize($subformField->subformLeadStore, true);

        foreach ($fields as $field) {
            if (!$field['field'] || !$field['leadStore']) {
                continue;
            }

            $this->storeSubformFieldData($field['field'], $field['leadStore']);
        }
    }

    /**
     * Store the data of a sub form field.
     *
     * @param int      $fieldId   The field id.
     * @param int|bool $leadStore The lead store field or setting.
     *
     * @return void
     */
    private function storeSubformFieldData($fieldId, $leadStore)
    {
        $field = \FormFieldModel::findByPK($fieldId);
        $data  = array();

        if ($this->hasLeadMaster()) {
            $masterField = \FormFieldModel::findByPk($leadStore);

            if (!$masterField) {
                return;
            }

            $fieldName = $masterField->name;
            $masterId  = $masterField->id;
        } else {
            $fieldName = $field->name;
            $masterId  = $field->id;
        }

        // Regular data
        if (isset($this->postData[$field->name])) {
            $value = \Leads::prepareValue($this->postData[$field->name], $field);
            $label = \Leads::prepareLabel($value, $field);

            $data = array(
                'pid'       => $this->leadId,
                'sorting'   => $field->sorting,
                'tstamp'    => time(),
                'master_id' => $masterId,
                'field_id'  => $field->id,
                'name'      => $fieldName,
                'value'     => $value,
                'label'     => $label,
            );
        }
        // Files
        if (isset($this->files[$field->name]) && $this->files[$field->name]['uploaded']) {
            $value = \Leads::prepareValue($this->files[$field->name], $field);
            $label = \Leads::prepareLabel($value, $field);

            $data = array(
                'pid'       => $this->leadId,
                'sorting'   => $field->sorting,
                'tstamp'    => time(),
                'master_id' => $field->master_id,
                'field_id'  => $field->id,
                'name'      => $field->name,
                'value'     => $value,
                'label'     => $label,
            );
        }

        $this->insertIntoDatabase($field, $data);
    }

    /**
     * Check if the form has a separate lead master.
     *
     * @return bool
     */
    private function hasLeadMaster()
    {
        return !empty($this->form['leadMaster']);
    }

    /**
     * Insert the data into the database.
     *
     * @param \FormFieldModel $field The related form field.
     * @param array           $data  The data being stored.
     *
     * @return void
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    private function insertIntoDatabase($field, $data)
    {
        if (!empty($data)) {
            // HOOK: add custom logic
            if (isset($GLOBALS['TL_HOOKS']['modifyLeadsDataOnStore'])
                && is_array($GLOBALS['TL_HOOKS']['modifyLeadsDataOnStore'])
            ) {
                foreach ($GLOBALS['TL_HOOKS']['modifyLeadsDataOnStore'] as $callback) {
                    $object = \Controller::importStatic($callback[0]);
                    $object->$callback[1](
                        $this->postData,
                        $this->form,
                        $this->files,
                        $this->leadId,
                        new Collection([$field], 'tl_form_field'),
                        $data
                    );
                }
            }

            \Database::getInstance()
                ->prepare('INSERT INTO tl_lead_data %s')
                ->set($data)
                ->execute();
        }
    }
}
