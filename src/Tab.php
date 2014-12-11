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
    protected $form;

    /** @var Tab Pointer to parent tab */
    protected $tab;

    /** @var string Path to tab view file */
    protected $view = 'tab/index';

    /** @var string Path to tab view file */
    protected $topView = 'tab/tab';

    /** @var string Path to content view file */
    protected $contentView = 'tab/content';

    /** @var string HTML rendered tab top string */
    protected $outputTop;

    /** @var string HTML rendered tab Content string */
    protected $outputContent;

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

    /**
     * Render tab top part
     */
    protected function renderTop()
    {
        $html = '';

        // Iterate all child tabs
        foreach ($this->children as $child) {
            // Render each child tab tab view
            $html .= $child->renderTop();
        }

        // Render tab tab view with child tabs
        $this->outputTop = $this->renderer
            ->view($this->topView)
            ->set('tabs', $html)
            ->output();

        // Fire event that tab top has been rendering
        Event::fire('cms_ui.tab_render_top', array(&$this, &$this->outputTop));

        return $this->outputTop;
    }

    /**
     * Render tab content part
     */
    protected function renderContent()
    {
        $html = '';

        // Iterate all child tabs
        foreach ($this->children as $child) {
            // Render each child tab content view
            $html .= $child->renderContent();
        }

        // Render tab content view with child tabs
        $this->outputContent = $this->renderer
            ->view($this->contentView)
            ->set('tabs', $html)
            ->output();

        // Fire event that tab top has been rendering
        Event::fire('cms_ui.tab_render_content', array(&$this, &$this->outputContent));

        return $this->outputContent;
    }

    /**
     * Render tab HTML. Method calls all child tabs
     * rendering.
     * @return string Tab HTML
     */
    public function render()
    {
        // Render tab consisting of two parts
        $this->output = $this->renderer
            ->view($this->view)
            ->set('tab', $this->renderTop())
            ->set('content', $this->renderContent())
            ->output();

        // Fire event that tab has been rendering
        Event::fire('cms_ui.tab_render', array(&$this, &$this->output));

        return $this->output;
    }
}

