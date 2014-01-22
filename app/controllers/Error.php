<?php

namespace Controller;

/**
 * Special Controller for Error handling
 */
class Error extends BaseController
{
    /**
     * Prevent to show BaseController::actionIndex
     * 
     * @return string
     */
    public function actionIndex()
    {
        return $this->show404('');
    }

    /**
     * Show 404 Page
     * 
     * @param string $action  Action in URL
     * @param \HttpNotFoundException $exception
     * @return string
     */
    public function show404($action, \HttpNotFoundException $exception = null)
    {
        if ($this->config['app']['env'] !== \Framework::PRODUCTION) {
            $error = is_null($exception) ? null : $exception->getMessage();
        } else {
            $error = null;
        }
        
        $this->response->setStatusCode(404);
        return $this->templating->render('404.html', ['error' => $error]);
    }

    /**
     * Show 500 Page
     * 
     * @param string $action  Action in URL
     * @param \Exception $exception
     * @return string
     */
    public function show500($action, \Exception $exception = null)
    {
        if ($this->config['app']['env'] !== \Framework::PRODUCTION) {
            $error = is_null($exception) ? null : $exception->getMessage();
        } else {
            $error = null;
        }
        
        $this->response->setStatusCode(500);
        return $this->templating->render('500.html', ['error' => $error]);
    }
}
