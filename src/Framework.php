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
    /**
     * Constants for Application Environments
     */
    const PRODUCTION = 'PRODUCTION';
    const DEVELOPMENT = 'DEVELOPMENT';
    
    /**
     * @var Container
     */
    protected $container;
    
    protected $config;
    protected $router;
    protected $request;
    
    /**
     *
     * @var Response
     */
    protected $response;
    
    protected $templating;

    public function __construct($container, $config, $router, $request, $response, $templating)
    {
        $this->container  = $container;
        $this->config     = $config;
        $this->router     = $router;
        $this->request    = $request;
        $this->response   = $response;
        $this->templating = $templating;
    }

    /**
     * Run Application
     */
    public function run()
    {
        list($controller, $action, $params) = $this->router->getRoute();
        
        try {
            $controllerFilePath = APPPATH . '/Controller/' . $controller . '.php';
            $controllerName = 'Controller\\' . $controller;
            if (! file_exists($controllerFilePath)) {
                throw new HttpNotFoundException($controllerName . ' is not found.');
            }
            
            $c = $this->container->resolve($controllerName);
            $c->injectCoreDependancy(
                $this->config, $this->request, $this->response, $this->templating
            );
            
            $body = $c->run($action, $params);
        } catch (HttpNotFoundException $e) {
            $c = $this->container->resolve('Controller\\Error');
            $c->injectCoreDependancy(
                $this->config, $this->request, $this->response, $this->templating
            );
            
            $body = $c->show404($action, $e);
        } catch (\Exception $e) {
            $c = $this->container->resolve('Controller\\Error');
            $c->injectCoreDependancy(
                $this->config, $this->request, $this->response, $this->templating
            );
            
            $body = $c->show500($action, $e);
        }
        
        $this->response->setBody($body);
        $this->response->send();
    }
}
