<?php

namespace Controller;

class BaseController
{
    /**
     * @var \kenjis\OreOrePHP\Config
     */
    protected $config;
    
    /**
     * @var \kenjis\OreOrePHP\Request
     */
    protected $request;
    
    /**
     * @var \kenjis\OreOrePHP\Response
     */
    protected $respose;
    
    /**
     * Template Engine
     * @var object
     */
    protected $templating;
    
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct()
    {
    }

    public function injectCoreDependancy(
        \Config $config,
        \Request $request,
        \Response $response,
        \Psr\Log\LoggerInterface $logger,
        $templating
        
    )
    {
        $this->config     = $config;
        $this->request    = $request;
        $this->response   = $response;
        $this->logger     = $logger;
        $this->templating = $templating;
    }

    protected function show404($action, \HttpNotFoundException $exception = null)
    {
        $this->response->setStatusCode(404);
        throw new \HttpNotFoundException(get_class($this) . '::' . $action . ' is not found.');
    }

    /**
     * Run Controller action
     * 
     * @param string $action
     * @param array $params
     * @return string
     */
    public function run($action, $params = [null, null, null])
    {
        $actionMethod = $this->findActionMethod($action);

        if (! $this->methodExists($actionMethod)) {
            $error = get_class($this) . '::' . $actionMethod . ' is not found.';
            $this->logger->error($error);
            return $this->show404($actionMethod);
        }

        return $this->$actionMethod($params[0], $params[1], $params[2]);
    }

    protected function methodExists($method)
    {
        return method_exists($this, $method);
    }

    protected function findActionMethod($action)
    {
        $reqestMethod = strtolower($this->request->getServer('REQUEST_METHOD'));
        $actionMethod = $reqestMethod . ucfirst($action);
        if (! $this->methodExists($actionMethod)) {
            $actionMethod = 'action' . ucfirst($action);
        }
        
        return $actionMethod;
    }

    public function actionIndex()
    {
        return 'actionIndex() (default action) of BaseController';
    }
}
