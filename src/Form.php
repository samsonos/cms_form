<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 11.12.2014
 * Time: 19:32
 */
namespace samsonos\cms\ui;

use samson\core\Event;
use samson\core\IViewable;

/**
 * Class Form
 * @package samsonos\cms\form
 */
class Form extends Container
{
    /**
     * @param \samson\core\IViewable $renderer Renderer object
     * @param Container $parent Pointer to parent form container
     */
    public function __construct(IViewable & $renderer, Container & $parent = null)
    {
        // Fire event that form has been created
        Event::fire('cms_ui.form_created', array(&$this));

        parent::__construct($renderer, $parent);
    }
}
