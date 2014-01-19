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

class Pimple
{
    private $container;
    
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
    private function injectControllerConstructor($class)
    {
        $c = $this->container;
        // Inject Twig
        $c[$class] = function ($c) use ($class) {
            return new $class($c['Twig_Environment']);
        };
    }
}
