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

class Dice
{
    protected $container;
    
    public function __construct(\Jasrags\Dice $container)
    {
        $this->container = $container;
    }
    
    public function resolve($class)
    {
        return $this->container->create($class);
    }
}
