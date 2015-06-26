<?php

/**
 * @package    contao-subforms
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2015 netzmacht creative David Molineus
 * @license    LGPL 3.0
 * @filesource
 *
 */

namespace Netzmacht\Contao\Subforms\Form;

/**
 * The sub from form field.
 *
 * @package Netzmacht\Contao\Subforms\Form
 */
class SubformField extends \Widget
{
    /**
     * The template name.
     *
     * @var string
     */
    protected $strTemplate = 'form_subform';

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.Superglobals)
     */
    public function generate()
    {
        if (TL_MODE === 'BE') {
            $template = new \BackendTemplate('be_wildcard');

            $subform = \FormModel::findByPk($this->subform);

            $template->wildcard = sprintf('### %s ###', $GLOBALS['TL_LANG']['tl_form_field']['subform'][0]);
            $template->id       = $this->id;
            $template->link     = $subform->title;
            $template->href     = sprintf(
                'contao/main.php?do=form&table=tl_form_field&id=%s&rt=%s',
                $this->subform,
                \RequestToken::get()
            );

            return $template->parse();
        }

        return '';
    }
}
