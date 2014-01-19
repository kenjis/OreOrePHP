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

namespace kenjis\OreOrePHP;

class Framework
{
    protected $container;
    protected $config;
    protected $router;
    protected $request;
    
    /**
     *
     * @var Response
     */
    protected $response;

    public function __construct($container, $config, $router, $request, $response)
    {
        $this->container = $container;
        $this->config    = $config;
        $this->router    = $router;
        $this->request   = $request;
        $this->response  = $response;
    }

    /**
     * Run Application
     */
    public function run()
    {
        list($controller, $action, $params) = $this->router->getRoute();
        
        try {
            $controllerFilePath = ROOTPATH . '/app/controllers/' . $controller . '.php';
            $controllerName = 'Controller\\' . $controller;
            if (! file_exists($controllerFilePath)) {
                $this->response->setStatusCode(404);
                throw new HttpNotFoundException($controllerName . ' is not found.');
            }
            
            $c = $this->container->resolve($controllerName);
            $c->injectCoreDependancy($this->config, $this->request, $this->response);
            
            $body = $c->run($action, $params);
            $this->response->setBody($body);
            
            $this->response->send();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
