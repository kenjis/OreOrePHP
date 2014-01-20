<?php
/**
 * Part of the OreOrePHP framework.
 *
 * @package    OreOrePHP
 * @version    0.1
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2014 Kenji Suzuki
 * @link       https://github.com/kenjis/OreOrePHP
 */

namespace kenjis\OreOrePHP\Container;

use kenjis\OreOrePHP\ContainerInterface;

class Pimple implements ContainerInterface
{
    protected $container;
    
    public function __construct(\Pimple $container)
    {
        $this->container = $container;
    }
    
    public function resolve($class)
    {
        if (substr($class, 0, 11) === 'Controller\\') {
            $this->injectControllerConstructor($class);
        }
        return $this->container[$class];
    }
    
    /**
     * Automatic Constructor Injection for Controllers
     * 
     * @param string $class
     * @return void
     */
    protected function injectControllerConstructor($class)
    {
        $c = $this->container;
        $c[$class] = function ($c) use ($class) {
            return new $class();
        };
    }
}
