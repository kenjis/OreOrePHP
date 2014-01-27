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
    const TEST = 'TEST';
    
    /**
     * @var \kenjis\OreOrePHP\ContainerInterface
     */
    protected $container;
    
    protected $config;
    
    /**
     * @var \kenjis\OreOrePHP\RouterInterface
     */
    protected $router;
    
    protected $request;
    
    /**
     * @var \kenjis\OreOrePHP\Response
     */
    protected $response;
    
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;
    
    protected $templating;

    public function __construct(
        $container, $config, $router, $request, $response, $logger, $templating
    )
    {
        $this->container  = $container;
        $this->config     = $config;
        $this->router     = $router;
        $this->request    = $request;
        $this->response   = $response;
        $this->logger     = $logger;
        $this->templating = $templating;
    }

    /**
     * Run Application
     */
    public function run()
    {
        list($controllerName, $action, $params) = $this->router->getRoute();
        
        try {
            $controllerFilePath = $this->config['app']['path'] . '/Controller/' . $controllerName . '.php';
            $FullControllerName = 'Controller\\' . $controllerName;
            if (! file_exists($controllerFilePath)) {
                $error = $FullControllerName . ' is not found.';
                $this->logger->error($error);
                throw new HttpNotFoundException($error);
            }
            
            $controller = $this->container->resolve($FullControllerName);
            $controller->injectCoreDependancy(
                $this->config, $this->request, $this->response, 
                $this->logger, $this->templating
            );
            
            $body = $controller->run($action, $params);
        } catch (HttpNotFoundException $e) {
            $controller = $this->container->resolve('Controller\\Error');
            $controller->injectCoreDependancy(
                $this->config, $this->request, $this->response, 
                $this->logger, $this->templating
            );
            
            $body = $controller->show404($action, $e);
        } catch (\Exception $e) {
            //var_dump($e); exit;
            $controller = $this->container->resolve('Controller\\Error');
            $controller->injectCoreDependancy(
                $this->config, $this->request, $this->response, 
                $this->logger, $this->templating
            );
            
            $body = $controller->show500($action, $e);
        }
        
        $this->response->setBody($body);
        $this->response->send();
    }
}
