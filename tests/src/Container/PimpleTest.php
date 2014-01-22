<?php

namespace kenjis\OreOrePHP\Container;

/**
 * @group OreOrePHP
 * @group Container
 */
class PimpleTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Pimple
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
            $c = new \Pimple();
            // Templating (Twig)
            $c['templating'] = $c->share(function ($c) {
                $loader = new \Twig_Loader_Filesystem(ROOTPATH . '/app/views');
                return new \Twig_Environment($loader, ['cache' => ROOTPATH . '/cache']);
            });
            
            $container = new Pimple($c);
            $this->object = $container;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function testResolve_Twig() {
        $test = $this->object->resolve('templating');
        $this->assertInstanceOf('Twig_Environment', $test);
    }
    
    public function testResolve_Controller_Hello() {
        $test = $this->object->resolve('Controller\\Hello');
        $this->assertInstanceOf('Controller\\Hello', $test);
    }

}
