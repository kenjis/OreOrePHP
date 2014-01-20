<?php

namespace kenjis\OreOrePHP\Router;

use Mockery as m;

/**
 * @group OreOrePHP
 * @group Router
 * @group Phalcon
 */
class PhalconTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Phalcon
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        m::close();
    }

    public function routeProvider()
    {
        return [
            // 4th param or later is ignored
            ['/hello/say/ore/abc/def/xxx', ['Hello', 'say', ['ore', 'abc', 'def']]],
            
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
     * @covers kenjis\OreOrePHP\Router\Phalcon::getRoute
     * @dataProvider routeProvider
     */
    public function testGetRoute($pathInfo, $expected)
    {
        $request = m::mock('kenjis\OreOrePHP\Request');
        $request->shouldReceive('getServer')->with('PATH_INFO')->andReturn($pathInfo);
        $object = new Phalcon($request);
        
        $test = $object->getRoute();
        $this->assertEquals($expected, $test);
    }

}
