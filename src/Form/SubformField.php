<?php

/**
 * @package    dev
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
     */
    public function generate()
    {
        if (TL_MODE === 'BE') {
            $template = new \BackendTemplate('be_wildcard');

            $template->wildcard = sprintf('### Subform %s ###', $this->name);
            $template->id       = $this->id;

            return $template->parse();
        }

        return '';
    }
}
