<?php

namespace kenjis\OreOrePHP;

/**
 * Mock for header() function
 */
function header()
{
    
}

/**
 * @group OreOrePHP
 * @group Response
 */
class ResponseTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Response
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Response;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function testSend() {
        $expected = 'This is HTTP body for testing.';
        $this->object->setStatusCode(404);
        $this->object->setHttpHeader('Content-Type', 'text/plain');
        $this->object->setBody($expected);
        
        ob_start();
        $test = $this->object->send();
        $output = ob_get_clean();
        $this->assertEquals($expected, $output);
    }

}
