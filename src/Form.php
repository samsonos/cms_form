<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 11.12.2014
 * Time: 19:32
 */
namespace samsonos\cms\ui;

/**
 * Class Form
 * @package samsonos\cms\form
 */
class Form extends Container
{
    public function __construct(Form & $parent = null)
    {
        // Fire event that form has been created
        \samson\core\Event::fire('cms_ui.form_created', array(&$this));

        parent::__construct($parent);
    }
}
