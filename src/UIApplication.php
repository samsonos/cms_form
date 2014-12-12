<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 12.12.2014
 * Time: 11:41
 */

namespace samsonos\cms\ui;

use samson\core\CompressableService;

/**
 * User interface SamsonCMS application
 * @package samsonos\cms\ui
 * @author Vitaly Iegorov <egorov@samsonos.com>
 */
class UIApplication extends CompressableService
{
    /** @var string Identifier */
    protected $id = 'ui';

    /** @var Container Pointer to current top container */
    protected $top;

    /** @var Container[] Collection of opened containers */
    protected $openedContainers = array();

    /*
     * Initialize service
     */
    public function init(array $params = array())
    {
        // Create top parent container
        $this->top = new Container($this);
    }

    /**
     * Show UI form by identifier
     * @param string $identifier Container identifier
     */
    public function container($identifier)
    {
        // Get container by identifier
        $container = & $this->openedContainers[$identifier];
        if (isset($container)) {

        }
    }

    /** Controllers */
    public function __container($identifier = null)
    {
        $form = new Form($this);
        $form->add(new TabView($form));

        $this->top->add(new Menu());
        $this->top->add($form);

        $this->view('window/index')->content($form);
    }
}
