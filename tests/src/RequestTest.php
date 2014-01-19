<?php

namespace kenjis\OreOrePHP;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-01-19 at 12:21:39.
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Request
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $get    = ['foo' => 'bar'];
        $post   = ['baz' => 'xyz'];
        $server = ['hoge' => 'geho'];
        $this->object = new Request($get, $post, $server);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @covers kenjis\OreOrePHP\Request::fromGlobals
     * @todo   Implement testFromGlobals().
     */
    public function testFromGlobals()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }

    /**
     * @covers kenjis\OreOrePHP\Request::getGet
     */
    public function testGetGet()
    {
        $test = $this->object->getGet('foo');
        $expected = 'bar';
        $this->assertEquals($expected, $test);
    }

    /**
     * @covers kenjis\OreOrePHP\Request::getPost
     */
    public function testGetPost()
    {
        $test = $this->object->getPost('baz');
        $expected = 'xyz';
        $this->assertEquals($expected, $test);
    }

    /**
     * @covers kenjis\OreOrePHP\Request::getServer
     */
    public function testGetServer()
    {
        $test = $this->object->getServer('hoge');
        $expected = 'geho';
        $this->assertEquals($expected, $test);
    }

}
