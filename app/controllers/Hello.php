<?php

namespace Controller;

class Hello extends BaseController
{
    public function actionSay($name)
    {
        $now = date('Y-m-d H:i:s');
        return $this->templating->render('hello.html', ['now' => $now, 'name' => $name]);

        //return 'Hello ' . $name;
    }
}