<?php

namespace Controller;

class BaseController
{
    protected $config;
    
    /**
     * @var \kenjis\OreOrePHP\Request
     */
    protected $request;
    protected $respose;
    protected $templating;
    
    public function __construct(
        \Twig_Environment $template = null
    )
    {
        $this->templating = $template;
    }

    public function injectCoreDependancy(
        \Config $config,
        \Request $request,
        \Response $response
    )
    {
        $this->config   = $config;
        $this->request  = $request;
        $this->response = $response;
    }

    protected function show404($action)
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

        if (! method_exists($this, $actionMethod)) {
            $this->show404($actionMethod);
        }

        return $this->$actionMethod($params[0], $params[1], $params[2]);
    }

    protected function findActionMethod($action)
    {
        $reqestMethod = strtolower($this->request->getServer('REQUEST_METHOD'));
        $actionMethod = $reqestMethod . ucfirst($action);
        if (! method_exists($this, $actionMethod)) {
            $actionMethod = 'action' . ucfirst($action);
        }
        
        return $actionMethod;
    }

    public function actionIndex()
    {
        return 'actionIndex() (default action) of BaseController';
    }
}
