<?php

namespace Controller;

use Mockery as m;

/**
 * @group App
 */
class BaseControllerTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var BaseController
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new BaseController;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        m::close();
    }

    public function findActionMethodProvider()
    {
        return [
            ['GET', false, 'actionIndex'],
            ['GET', true, 'getIndex'],
            ['POST', false, 'actionIndex'],
            ['POST', true, 'postIndex'],
        ];
    }
    
    /**
     * @covers Controller\BaseController::findActionMethod
     * @dataProvider findActionMethodProvider
     */
    public function testfindActionMethod_actionIndex($requestMethod, $methodExists, $expected)
    {
        $request = m::mock('kenjis\OreOrePHP\Request')
            ->shouldReceive('getServer')
            ->with('REQUEST_METHOD')
            ->andReturn($requestMethod)
            ->getMock();
        $obj = m::mock('Controller\\BaseController[methodExists]')
           ->shouldAllowMockingProtectedMethods()
           ->shouldReceive('methodExists')
           ->andReturn($methodExists)
           ->getMock();

        \Closure::bind(function () use ($obj, $request, $expected) {
            // set protected property
            $obj->request = $request;
            // test protected method
            $test = $obj->findActionMethod('index');
            $this->assertEquals($test, $expected);
        }, $this, 'Controller\\BaseController')->__invoke();
    }

    /**
     * @covers Controller\BaseController::injectCoreDependancy
     * @todo   Implement testInjectCoreDependancy().
     */
    public function testInjectCoreDependancy() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Controller\BaseController::run
     * @todo   Implement testRun().
     */
    public function testRun() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers Controller\BaseController::actionIndex
     * @todo   Implement testActionIndex().
     */
    public function testActionIndex() {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

}
