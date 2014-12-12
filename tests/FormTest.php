<?php
namespace tests;

use samson\core\Error;
use samsonos\cms\ui\Form;

/**
 * Created by Vitaly Iegorov <egorov@samsonos.com>
 * on 04.08.14 at 16:42
 */
class FormTest extends \PHPUnit_Framework_TestCase
{
    /** @var Form Pointer to form */
    public $form;

    /** @var samson\core\IViewable Mock */
    public $viewable;

    /** Tests init */
    public function setUp()
    {
        // Create mock
        $this->viewable = $this->getMockBuilder('samson\core\IViewable')
            ->disableOriginalConstructor()
            ->getMock();

        // Get instance using services factory as error will signal other way
        $this->form = new Form($this->viewable);

        // Disable default error output
        Error::$OUTPUT = false;
    }

    /** Empty test */
    public function testCreation()
    {
        $this->assertEquals(true, true);
    }
}
