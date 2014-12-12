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
     * Render tab HTML. Method calls all child tabs
     * rendering.
     * @return string TabView HTML
     */
    public function render()
    {
        $bodyHtml = '';
        $headerHtml = '';

        /** @var Tab $child Render separately child tabs body & headers */
        foreach ($this->children as $child) {
            $headerHtml .= $child->header->render();
            $bodyHtml .= $child->body->render();
        }

        // Render tab consisting of two parts
        $this->output = $this->renderer
            ->view($this->view)
            ->set('header_html', $headerHtml)
            ->set('body_html', $bodyHtml)
            ->output();

        // Fire event that tab has been rendering
        Event::fire('cms_ui.tab_rendered', array(&$this, &$this->output));

        return $this->output;
    }
}
