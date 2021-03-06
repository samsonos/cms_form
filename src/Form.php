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
 * @author Vitaly Iegorov <egorov@samsonos.com>
 */
class Form extends Container
{
    /** @var string Path to container view file */
    protected $view = 'form/index';

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
