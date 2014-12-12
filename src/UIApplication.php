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

    /** @var Container[] Collection of loaded containers */
    protected $containers = array();

    /**
     * Show UI form by identifier
     * @param string $identifier Container identifier
     */
    public function container($identifier)
    {
        // Get container by identifier
        $container = & $this->containers[$identifier];
        if (isset($container)) {

        }
    }
}
