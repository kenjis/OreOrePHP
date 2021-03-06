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

class Pux implements RouterInterface
{
    protected $appPath;
    protected $request;
    
    public function __construct($appPath, Request $request)
    {
        $this->appPath = $appPath;
        $this->request = $request;
    }

    /**
     * Get Route
     * 
     * @return array
     */
    public function getRoute()
    {
        // Whether use Pux Compiled Mux or not
        $useMux = $this->request->getServer('ORE_USE_MUX');
        
        if ($useMux) {
            //echo 'use mux';
            $mux = require $this->appPath . '/config/routes.pux.mux.php';
        } else {
            //echo 'not use mux';
            $mux = require $this->appPath . '/config/routes.pux.php';
        }

        $pathinfo = $this->request->getServer('PATH_INFO') ?: '/';
        if ($pathinfo !== '/') {
            $pathinfo = rtrim($pathinfo, '/');
        }
        $route = $mux->dispatch($pathinfo);
        //var_dump($pathinfo, $route);

        // Resolve controller name
        if ($route[2][0] === ':dummy') {
            $controllerName = ucfirst($route[3]['vars']['controller']);
        } elseif ($route === null) {
            $controllerName = '__No_Route_Found__';
        } else {
            $controllerName = ucfirst($route[2][0]);
        }

        // Resolve action method name
        if ($route[2][1] === ':dummy') {
            if (isset($route[3]['vars']['action'])) {
                $action = $route[3]['vars']['action'];
            } else {
                $action = 'index';
            }
        } elseif ($route === null) {
            $action = '__No_Route_Found__';
        } else {
            $action = $route[2][1];
        }

        // Resolve URI segment params, you can use 3 URI segments
        for ($i = 0; $i < 3; $i++) {
            $params[$i] = isset($route[3]['vars']['param' . $i]) ? $route[3]['vars']['param' . $i] : null;
        }

        //var_dump($controllerName, $action, $params);
        return [$controllerName, $action, $params];
    }
}
