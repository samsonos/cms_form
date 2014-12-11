<?php
namespace tests;

use samson\fs\FileService;
use samson\fs\LocalFileService;

/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>
 * on 04.08.14 at 16:42
 */
class FormTest extends \PHPUnit_Framework_TestCase
{
    /** @var \samsonos\cms\form\Form Pointer to form */
    public $form;

    /** Tests init */
    public function setUp()
    {
        // Get instance using services factory as error will signal other way
        $this->form = new \samsonos\cms\form\Form();

        // Disable default error output
        \samson\core\Error::$OUTPUT = false;
    }
}
