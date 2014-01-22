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

namespace kenjis\OreOrePHP\Router;

use kenjis\OreOrePHP\RouterInterface;
use kenjis\OreOrePHP\Request;

class Phalcon implements RouterInterface
{
    protected $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get Route
     * 
     * @return array
     */
    public function getRoute()
    {
        $router = require APPPATH . '/config/routes.phalcon.php';
        $pathinfo = $this->request->getServer('PATH_INFO') ?: '/';
        $router->handle($pathinfo);
        
        $controller = ucfirst($router->getControllerName());
        
        $action = $router->getActionName();
        if ($action !== null) {
            $action = $action;
        } else {
            $action = 'index';
        }
        
        $phalconParams = $router->getParams();
        for ($i = 0; $i < 3; $i++) {
            $params[$i] = isset($phalconParams[$i]) ? $phalconParams[$i] : null;
        }

        //var_dump($controller, $action, $params);
        return [$controller, $action, $params];
    }
}
