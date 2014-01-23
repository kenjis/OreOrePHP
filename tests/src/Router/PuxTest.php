<?php

namespace kenjis\OreOrePHP\Router;

use Mockery as m;

/**
 * @group OreOrePHP
 * @group Router
 */
class PuxTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Pux
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        m::close();
    }

    public function routeProvider()
    {
        return [
            // No matched route, error
            ['/hello/say/ore/abc/def/xxx', ['__No_Route_Found__', '__No_Route_Found__', [null, null, null]]],
            
            // Normal routes
            ['/hello/say/ore/abc/def/', ['Hello', 'say', ['ore', 'abc', 'def']]],
            ['/hello/say/ore/abc/def',  ['Hello', 'say', ['ore', 'abc', 'def']]],
            ['/hello/say/ore/abc',      ['Hello', 'say', ['ore', 'abc', null]]],
            ['/hello/say/ore/', ['Hello', 'say',   ['ore', null, null]]],
            ['/hello/say/ore',  ['Hello', 'say',   ['ore', null, null]]],
            ['/hello/say/',     ['Hello', 'say',   [null,  null, null]]],
            ['/hello/say',      ['Hello', 'say',   [null,  null, null]]],
            ['/hello/',         ['Hello', 'index', [null,  null, null]]],
            ['/hello',          ['Hello', 'index', [null,  null, null]]],
            ['/',               ['Hello', 'index', [null,  null, null]]],
        ];
    }
    
    /**
     * @covers kenjis\OreOrePHP\Router\Pux::getRoute
     * @dataProvider routeProvider
     */
    public function testGetRoute_Controller_Method_Param($pathInfo, $expected)
    {
        $request = m::mock('kenjis\OreOrePHP\Request');
        $request->shouldReceive('getServer')->with('ORE_USE_MUX')->andReturn(null);
        $request->shouldReceive('getServer')->with('PATH_INFO')->andReturn($pathInfo);
        $object = new Pux(APPPATH, $request);
        
        $test = $object->getRoute();
        $this->assertEquals($expected, $test);
    }
    
    /**
     * @covers kenjis\OreOrePHP\Router\Pux::getRoute
     */
    public function testGetRoute_USE_MUX_On()
    {
        $request = m::mock('kenjis\OreOrePHP\Request');
        $request->shouldReceive('getServer')->with('ORE_USE_MUX')->andReturn('1');
        $request->shouldReceive('getServer')->with('PATH_INFO')->andReturn('/hello/say/ore');
        $object = new Pux(APPPATH, $request);
        
        $test = $object->getRoute();
        $expected = ['Hello', 'say', ['ore', null, null]];
        $this->assertEquals($expected, $test);
    }

}
