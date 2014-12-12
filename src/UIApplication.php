<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 12.12.2014
 * Time: 11:41
 */
namespace samsonos\cms\ui;

use samson\core\Event;
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

    /** @var Container Pointer to current workspace container */
    protected $workspace;

    /** @var Container[] Collection of opened containers */
    protected $openedContainers = array();

    /*
     * Initialize UI service
     */
    public function init(array $params = array())
    {
        // Create top parent container
        $this->workspace = new Container($this);

        // Create main UI menu
        $menu = new Menu($this);

        // Create home item
        $homeItem = new MenuItem($menu);
        $homeItem->set('title', 'Home')
            ->set('class', 'btnHome')
            ->set('content', '<a href="/">Home</a>')
        ;

        // Create site item
        $siteItem = new MenuItem($menu);
        $siteItem->set('title', 'Go to web-site')
            ->set('class', 'btnSite')
            ->set('content', '<a href="/"></a>')
        ;

        // Create exit item
        $exitItem = new MenuItem($menu);
        $siteItem->set('title', t('Выйти из SamsonCMS', true))
            ->set('class', 'btnExit')
            ->set('content', '<a href="/"></a>')
        ;

        // Fire event that ui menu container has been created
        Event::fire('cms_ui.mainmenu_created', array(&$menu, &$this));

        // Add main menu
        $this->workspace->add($menu);

        // Fire event that ui workspace container has been created
        Event::fire('cms_ui.workspace_created', array(&$this->workspace, &$this));

        return parent::init($params);
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

    /**
     * Render user interface
     */
    public function __handler()
    {
        // Set workspace template
        s()->template('www/index.vphp');

        // Render workspace
        $this->set('content_html', $this->workspace->render())
        ;
    }

    /** Controllers */
    public function __container($identifier = null)
    {
        $form = new Form($this);
        $form->add(new TabView($form));

        // Add this form to workspace
        $this->workspace->add($form);

        $this->view('window/index')->content($form);
    }
}
