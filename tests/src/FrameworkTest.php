<?php

namespace kenjis\OreOrePHP;

use AspectMock\Test as test;
use Mockery as m;

/**
 * @group OreOrePHP
 * @group Framework
 */
class FrameworkTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Framework
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
        test::clean();
        m::close();
    }

    /**
     * @covers kenjis\OreOrePHP\Framework::run
     */
    public function testRun_Success_AspectMock()
    {
        $dice = test::double('Jasrags\Dice')->make();
        $twig = test::double('Twig_Environment')->make();
        $hello = test::double(
            'App\Controller\Hello',
            ['run' => 'I am world.', 'injectCoreDependancy' => null]
        )->make();
        $container = test::double(
            'kenjis\OreOrePHP\Container\Dice',
            ['resolve' => function () use ($hello) {
                return $hello;
            }]
        )->construct($dice);
        $config = get_config();
        $router = test::double(
            'kenjis\OreOrePHP\Router\Pux',
            ['getRoute' => ['Hello', 'actionSay', ['world', null, null]]]
        )->make();
        $request = test::double('kenjis\OreOrePHP\Request')->make();
        $response = test::double(
            'kenjis\OreOrePHP\Response',
            ['setBody' => null, 'send' => 'I am world.']
        )->make();
        $logger = test::double('Monolog\Logger')->make();
        
        $object = new Framework($container, $config, $router, $request, $response, $logger, $twig);
        
        ob_start();
        $object->run();
        $output = ob_get_clean();
        $expected = 'I am world.';
        $this->assertEquals($expected, $output);
    }
    
    /**
     * @covers kenjis\OreOrePHP\Framework::run
     */
    public function testRun_Success_Mocery()
    {
        $dice = m::mock('Jasrags\Dice');
        $twig = m::mock('Twig_Environment');
        $config = get_config();
        $router = m::mock('kenjis\OreOrePHP\Router\Pux')
            ->shouldReceive('getRoute')
            ->andReturn(['Hello', 'actionSay', ['world', null, null]])
            ->getMock();
        $request = m::mock('kenjis\OreOrePHP\Request');
        $response = m::mock('kenjis\OreOrePHP\Response')
            ->shouldReceive('setBody')->with('I am world.')->andReturn(null)
            ->getMock();
        $response->shouldReceive('send')->andReturn('I am world.');
        $logger = m::mock('Monolog\Logger');
        $hello = m::mock('App\Controller\Hello');
        $hello->shouldReceive('run')->andReturn('I am world.');
        $hello->shouldReceive('injectCoreDependancy')
            ->with($config, $request, $response, $logger, $twig)->andReturn(null);
        $container = m::mock('kenjis\OreOrePHP\Container\Dice')
            ->shouldReceive('resolve')->with('App\Controller\Hello')->andReturn($hello)
            ->getMock();
        
        $object = new Framework($container, $config, $router, $request, $response, $logger, $twig);
        $test = $object->run();
        $expected = '';
        $this->assertEquals($expected, $test);
    }
    
    /**
     * 
     */
    public function testRun_ControllerNotFound()
    {
        $dice = m::mock('Jasrags\Dice');
        $twig = m::mock('Twig_Environment');
        $config = get_config();
        $router = m::mock('kenjis\OreOrePHP\Router\Pux')
            ->shouldReceive('getRoute')
            ->andReturn(['Notfound', 'actionNotfound', [null, null, null]])
            ->getMock();
        $request = m::mock('kenjis\OreOrePHP\Request');
        $response = m::mock('kenjis\OreOrePHP\Response');
        $response->shouldReceive('setStatusCode')->with(404)->andReturn(null);
        $response->shouldReceive('setBody')->with('404 Not Found')->andReturn(null);
        $response->shouldReceive('send')->andReturn(null);
        $logger = m::mock('Monolog\Logger');
        $logger->shouldReceive('error')->with('App\Controller\Notfound is not found.')->andReturn(null);
        
        $error = m::mock('App\Controller\Error');
        $error->shouldAllowMockingProtectedMethods();
        $error->shouldReceive('injectCoreDependancy')
            ->with($config, $request, $response, $logger, $twig)->andReturn(null);
        $error->shouldReceive('show404')->with('actionNotfound', 'kenjis\OreOrePHP\HttpNotFoundException')->andReturn('404 Not Found');
        $container = m::mock('kenjis\OreOrePHP\Container\Dice')
            ->shouldReceive('resolve')->with('App\Controller\Error')->andReturn($error)
            ->getMock();
        
        $object = new Framework($container, $config, $router, $request, $response, $logger, $twig);
        $test = $object->run();
        $this->assertEquals('', $test);
    }

}
