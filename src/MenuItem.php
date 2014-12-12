<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 12.12.2014
 * Time: 13:21
 */

namespace samsonos\cms\ui;

/**
 * UI menu item
 * @package samsonos\cms\ui
 * @author Vitaly Iegorov <egorov@samsonos.com>
 */
class MenuItem extends Container
{
    /** @var string Path to menu item view file */
    protected $view = 'window/menu/item';

    /** @var int Menu action */
    protected $action;
}