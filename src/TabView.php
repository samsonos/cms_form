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
 * Class TabView
 * @package samsonos\cms\form
 * @author Vitaly Iegorov <egorov@samsonos.com>
 */
class TabView extends Container
{
    /** @var string Path to tab view file */
    protected $view = 'tab/index';

    /** @var string Path to content view file */
    protected $contentView = 'tab/content';

    /**
     * @param Form $form Pointer to parent form container
     * @param TabView $tab Pointer to parent tab container
     * @param \samson\core\IViewable $renderer Renderer object
     */
    public function __construct(Form & $form)
    {
        // Fire event that tab has been created
        Event::fire('cms_ui.tabview_created', array(&$this));

        parent::__construct($form->renderer, $form);
    }

    /**
 * Render tab top part
 */
    protected function renderTop()
    {
        $html = '';

        /** @var TabView $child Iterate all child tabs */
        foreach ($this->children as $child) {
            // Render each child tab tab view
            $html .= $child->renderTop();
        }

        // Render tab tab view with child tabs
        $this->outputTop = $this->renderer
            ->view($this->topView)
            ->set('identifier', $this->identifier)
            ->set('content_html', $html)
            ->output();

        // Fire event that tab top has been rendering
        Event::fire('cms_ui.tab_rendered_top', array(&$this, &$this->outputTop));

        return $this->outputTop;
    }

    /**
     * Render tab content part
     */
    protected function renderContent()
    {
        $html = '';

        /** @var TabView $child Iterate all child tabs */
        foreach ($this->children as $child) {
            // Render each child tab content view
            $html .= $child->renderContent();
        }

        // Render tab content view with child tabs
        $this->outputContent = $this->renderer
            ->view($this->contentView)
            ->set('identifier', $this->identifier)
            ->set('content_html', $html)
            ->output();

        // Fire event that tab top has been rendering
        Event::fire('cms_ui.tab_rendered_content', array(&$this, &$this->outputContent));

        return $this->outputContent;
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
            ->set('top_html', $this->renderTop())
            ->set('content_html', $this->renderContent())
            ->output();

        // Fire event that tab has been rendering
        Event::fire('cms_ui.tab_rendered', array(&$this, &$this->output));

        return $this->output;
    }
}
