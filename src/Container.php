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
 * Generic UI container class
 * @package samsonos\cms\ui
 */
class Container
{
    /** @var Form Pointer to parent container */
    protected $parent;

    /** @var Container[] Collection of nested containers */
    protected $children = array();

    /** @var string Path to container view file */
    protected $view = 'index';

    /** @var mixed Renderer object */
    protected $renderer;

    /** @var string Container title */
    protected $title;

    /** @var string Container unique identifier */
    protected $identifier;

    /** @var string HTML rendered container string */
    protected $output;

    /**
     * @param Container $parent Add parent container
     * @param mixed $renderer Object for rendering container
     */
    public function __construct(& $renderer, Container & $parent = null)
    {
        // Define renderer
        $this->renderer = !isset($renderer) ? m() : $renderer;

        // Save pointer to parent form
        $this->parent = & $parent;

        // Fire event that ui container has been created
        Event::fire('cms_ui.container_created', array(&$this));
    }

    /**
     * Add child container to current container
     * @param Container $child Pointer to added child container
     */
    public function add(Container & $child)
    {
        $this->children[] = $child;
    }

    /**
     * Render container HTML. Method calls all child elements
     * rendering.
     * @return string Container HTML
     */
    public function render()
    {
        $html = '';

        // Iterate all child containers
        foreach ($this->children as $child) {
            // Perform child container rendering
            $html .= $child->render();
        }

        // Render container view with child containers
        return $this->renderer
            ->view($this->view)
            ->set('children', $html)
            ->output();
    }
}
