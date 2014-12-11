<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 11.12.2014
 * Time: 19:32
 */
namespace samsonos\cms\ui;

use samson\core\Event;

/**
 * Class Tab
 * @package samsonos\cms\form
 */
class Tab extends Container
{
    /** @var Form Pointer to parent form */
    public $form;

    /** @var Tab Pointer to parent tab */
    public $tab;

    /**
     * @param Form $form Pointer to parent form container
     * @param Tab $tab Pointer to parent tab container
     */
    public function __construct(Form & $form, Tab & $tab = null)
    {
        // Save pointer to parent form
        $this->form = & $form;

        // Save pointer to parent tab
        $this->tab = & $tab;

        // Fire event that tab has been created
        Event::fire('cms_ui.tab_created', array(&$this));

        // Define parent container
        $parent = isset($tab) ? $tab : $form;

        parent::__construct($parent);
    }
}

