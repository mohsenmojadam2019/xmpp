<?php

namespace Fabiang\Xmpp\Util;

use Fabiang\Xmpp\Exception\ErrorException;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-11-13 at 13:42:23.
 *
 * @coversDefaultClass Fabiang\Xmpp\Util\ErrorHandler
 */
class ErrorHandlerTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var ErrorHandler
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ErrorHandler(
            function ($message) {
                trigger_error($message, E_USER_WARNING);
            },
            'unit tests'
        );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        restore_error_handler();
    }

    /**
     * @covers ::__construct
     * @covers ::execute
     */
    public function testExecute()
    {
        try {
            $this->object->execute($file = __FILE__, $line = __LINE__);
        } catch (ErrorException $exception) {
            $this->assertSame('unit tests', $exception->getMessage());
            $this->assertSame($file, $exception->getFile());
            $this->assertSame($line, $exception->getLine());
            $this->assertSame(E_USER_WARNING, $exception->getSeverity());
            $this->assertSame(0, $exception->getCode());
        }
    }

    /**
     * @covers ::__construct
     * @expectedException \Fabiang\Xmpp\Exception\InvalidArgumentException
     * @expectedExceptionMessage Argument 1 of "Fabiang\Xmpp\Util\ErrorHandler::__construct" must be a callable
     */
    public function testConstructWithWrongType()
    {
        new ErrorHandler(1);
    }
}
