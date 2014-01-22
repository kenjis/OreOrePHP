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

    public function runProvider()
    {
        return [
            ['GET',  'index', false,  'actionIndex() (default action) of BaseController'],
            ['GET',  'index', true, 'getIndex'],
            ['POST', 'index', false,  'actionIndex() (default action) of BaseController'],
            ['POST', 'index', true, 'postIndex'],
        ];
    }
    
    /**
     * @dataProvider runProvider
     */
    public function testRun_Method_Found($requestMethod, $action, $methodExists, $expected) {
        $request = m::mock('kenjis\OreOrePHP\Request')
            ->shouldReceive('getServer')
            ->with('REQUEST_METHOD')
            ->andReturn($requestMethod)
            ->getMock();
        $config = m::mock('kenjis\OreOrePHP\Config');
        $response = m::mock('kenjis\OreOrePHP\Response');
        
        if ($requestMethod === 'GET') {
            $object = m::mock('Controller\\BaseController[methodExists]')
                ->shouldAllowMockingProtectedMethods()
                ->shouldReceive('methodExists')
                ->with('getIndex')
                ->andReturn($methodExists)
                ->shouldReceive('methodExists')
                ->with('actionIndex')
                ->andReturn(true)
                ->shouldReceive('getIndex')
                ->andReturn('getIndex')
                ->getMock();
        } else {
            $object = m::mock('Controller\\BaseController[methodExists]')
                ->shouldAllowMockingProtectedMethods()
                ->shouldReceive('methodExists')
                ->with('postIndex')
                ->andReturn($methodExists)
                ->shouldReceive('methodExists')
                ->with('actionIndex')
                ->andReturn(true)
                ->shouldReceive('postIndex')
                ->andReturn('postIndex')
                ->getMock();
        }
        
        $object->injectCoreDependancy($config, $request, $response, null);
        
        $test = $object->run($action);
        $this->assertEquals($expected, $test);
    }
    
    /**
     * @expectedException kenjis\OreOrePHP\HttpNotFoundException
     */
    public function testRun_Method_Not_Found() {
        $request = m::mock('kenjis\OreOrePHP\Request')
            ->shouldReceive('getServer')
            ->with('REQUEST_METHOD')
            ->andReturn('GET')
            ->getMock();
        $config = m::mock('kenjis\OreOrePHP\Config');
        $response = m::mock('kenjis\OreOrePHP\Response')
            ->shouldReceive('setStatusCode')
            ->with(404)
            ->andReturn(null)
            ->getMock();
        
        $object = m::mock('Controller\\BaseController[methodExists]')
            ->shouldAllowMockingProtectedMethods()
            ->shouldReceive('methodExists')
            ->with('getIndex')
            ->andReturn(false)
            ->shouldReceive('methodExists')
            ->with('actionIndex')
            ->andReturn(true)
            ->shouldReceive('methodExists')
            ->with('getNotexists')
            ->andReturn(false)
            ->shouldReceive('methodExists')
            ->with('actionNotexists')
            ->andReturn(false)
            ->getMock();
        $object->injectCoreDependancy($config, $request, $response, null);
        
        $test = $object->run('notexists');
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
