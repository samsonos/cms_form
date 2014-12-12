<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 11.12.2014
 * Time: 19:32
 */
namespace samsonos\cms\ui;

use samson\core\Event;
use \samson\core\IViewable;

/**
 * Tab container
 * @package samsonos\cms\form
 * @author Vitaly Iegorov <egorov@samsonos.com>
 */
class Tab extends Container
{
    /** @var string Path to tab view file */
    protected $view = 'tab/tab';

    /** @var Container Top container */
    protected $topContainer;

    /** @var Container Content container */
    protected $contentContainer;

    /**
     * @param TabView $tabView Pointer to parent tab view container
     * @param \samson\core\IViewable $renderer Renderer object
     */
    public function __construct(TabView & $tabView)
    {
        // Fire event that tab has been created
        Event::fire('cms_ui.tab_created', array(&$this));

        // Create top & conetnet containers
        $this->topContainer = new Container($tabView->renderer, $this);
        $this->contentContainer = new Container($tabView->renderer, $this);

        parent::__construct($tabView->renderer, $tabView);
    }

    /**
     * Render tab HTML. Method calls all child tabs
     * rendering.
     * @return string TabView HTML
     */
    public function render()
    {
        // Render tab consisting of two parts
        $this->output = $this->renderer
            ->view($this->view)
            ->set('top_html', $this->topContainer->render())
            ->set('content_html', $this->contentContainer->render())
            ->output();

        // Fire event that tab has been rendering
        Event::fire('cms_ui.tab_rendered', array(&$this, &$this->output));

        return $this->output;
    }
}
