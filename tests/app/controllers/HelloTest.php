<?php

namespace Controller;

use Mockery as m;

/**
 * Mock for date() function
 */
function date()
{
    return '2014-01-21 02:20:14';
}

/**
 * @group App
 */
class HelloTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Hello
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Hello;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        m::close();
    }

    /**
     * @covers Controller\Hello::actionSay
     */
    public function testActionSay() {
        $param = 'OreOrePHP';
        
        $config     = m::mock('kenjis\OreOrePHP\Config');
        $request    = m::mock('kenjis\OreOrePHP\Request');
        $response   = m::mock('kenjis\OreOrePHP\Response');
        $templating = m::mock('Twig_Environment')
            ->shouldReceive('render')
            ->with('hello.html', ['now' => '2014-01-21 02:20:14', 'name' => $param])
            ->andReturn('Rendered HTML')
            ->getMock();
        $logger = m::mock('Monolog\Logger');
        
        $object = new Hello;
        $object->injectCoreDependancy($config, $request, $response, $logger, $templating);

        $test = $object->actionSay($param);
        $expected = 'Rendered HTML';
        $this->assertEquals($expected, $test);
    }

}
