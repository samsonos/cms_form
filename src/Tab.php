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
    public $header;

    /** @var Container Content container */
    public $body;

    /**
     * @param Container $parent Pointer to parent container
     */
    public function __construct(Container & $parent)
    {
        // Create header containers
        $this->header = new Container($parent->renderer, $this);
        $this->header->set('view', 'tab/header');

        // Create body containers
        $this->body = new Container($parent->renderer, $this);
        $this->body->set('view', 'tab/body');

        /**
         * Add nested tab to current tab.
         * This overloaded add method also connects current tab header & body
         * with added tab header & body which gives generic recursion and separate
         * rendering of inner tab headers and body inside current tab header and body
         * and so on.
         */
        if (is_a($parent, 'samsonos\cms\ui\Tab')) {
            // Add nested tab header container to current header
            $parent->header->add($this->header);

            // Add nested tab body container to current body
            $parent->body->add($this->body);
        }

        // Fire event that tab has been created
        Event::fire('cms_ui.tab_created', array(&$this));

        parent::__construct($parent->renderer, $parent);
    }
}
