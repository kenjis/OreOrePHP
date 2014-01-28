<?php

namespace App\Controller;

class Hello extends BaseController
{
    /**
     * Say action
     * 
     * @param string $name
     * @return string
     */
    public function actionSay($name)
    {
        $now = date('Y-m-d H:i:s');
        return $this->templating->render('hello.html', ['now' => $now, 'name' => $name]);

        //return 'Hello ' . $name;
    }
}
