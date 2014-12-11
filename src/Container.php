<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 11.12.2014
 * Time: 19:32
 */
namespace samsonos\cms\ui;

/**
 * Generic UI container class
 * @package samsonos\cms\ui
 */
class Container
{
    /** @var Form Pointer to parent container */
    public $parent;

    /** @var Container[] Collection of nested containers */
    public $children = array();

    /**
     * @param Container $parent Add parent container
     */
    public function __construct(Container & $parent = null)
    {
        // Save pointer to parent form
        $this->parent = & $parent;

        // Save pointer to parent tab
        $this->tab = & $tab;

        // Fire event that ui container has been created
        \samson\core\Event::fire('cms_ui.container_created', array(&$this));
    }

    /**
     * Add child container to current container
     * @param Container $child Pointer to added child container
     */
    public function add(Container & $child)
    {
        $this->children[] = $child;
    }
}
