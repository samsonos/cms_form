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
use samson\core\IViewSettable;

/**
 * Generic UI container class
 * @package samsonos\cms\ui
 * @author Vitaly Iegorov <egorov@samsonos.com>
 */
class Container implements IViewSettable
{
    /** @var Form Pointer to parent container */
    protected $parent;

    /** @var Container[] Collection of nested containers */
    protected $children = array();

    /** @var string Path to container view file */
    protected $view = 'window/index';

    /** @var IViewable Renderer object */
    protected $renderer;

    /** @var string Container title */
    protected $title;

    /** @var string Container css class */
    protected $class;

    /** @var string Container unique identifier */
    protected $identifier;

    /** @var string HTML rendered container string */
    protected $content;

    /** @var string HTML rendered container string */
    protected $output;

    /**
     * @param Container $parent Add parent container
     * @param IViewable $renderer Object for rendering container
     */
    public function __construct(IViewable & $renderer, Container & $parent = null)
    {
        // Define renderer
        $this->renderer = & $renderer;

        // Save pointer to parent form
        $this->parent = & $parent;

        // Generate unique identifier
        $this->identifier = uniqid();

        // Generate generic title
        $this->title = get_class($this).$this->identifier;

        // If parent container is specified - add this container to it
        if (isset($parent)) {
            $parent->add($this);
        }

        // Fire event that ui container has been created
        Event::fire('cms_ui.container_created', array(&$this));
    }

    /**
     * Set container field value
     * @param string    $field  Field identifier
     * @param mixed     $value  Field value
     * @return Container Chaining
     */
    public function set($field, $value)
    {
        // Check field existence in object
        if (property_exists($this, $field)) {
            $this->$field = $value;
        }

        return $this;
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
     * Get container children collection
     * @return Container[] Collection of containers children
     */
    public function children()
    {
        return $this->children;
    }

    /**
     * Render container HTML. Method calls all child elements
     * rendering.
     * @return string Container HTML
     */
    public function render()
    {
        // Start rendering content with current content
        $html = $this->content;

        // Iterate all child containers
        foreach ($this->children as $child) {
            // Perform child container rendering
            $html .= $child->render();
        }

        // Render container view with child containers
        $this->output = $this->renderer
            ->view($this->view)
            ->set('title', $this->title)
            ->set('class', $this->class)
            ->set('identifier', $this->identifier)
            ->set('content_html', $html)
            ->output();

        // Fire event that container has been rendering
        Event::fire('cms_ui.container_rendered', array(&$this, &$this->output));

        return $this->output;
    }

    /**
     * Generate collection of view variables, prefixed if needed, that should be passed to
     * view context.
     *
     * @param string $prefix Prefix to be added to all keys in returned data collection
     * @return array Collection(key => value) of data for view context
     */
    public function toView($prefix = '')
    {
        // Return view variable collection with rendered form
        return array($prefix.'html' => $this->render());
    }
}
