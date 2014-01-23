<?php
/**
 * Service Definition for Pimple
 * 
 * Documentaion: https://github.com/fabpot/Pimple
 */

return function () {
    $c = new \Pimple();
    
    // Templating (Twig)
    $c['templating'] = $c->share(function ($c) {
        $loader = new \Twig_Loader_Filesystem(APPPATH . '/views');
        return new \Twig_Environment($loader, ['cache' => APPPATH . '/var/cache']);
    });
    
    // Logger (monolog)
    $c['logger'] = $c->share(function ($c) {
        $logger = new \Monolog\Logger('app');
        $logger->pushHandler(new \Monolog\Handler\StreamHandler(APPPATH . '/var/log/app.log'));
        return $logger;
    });
    
    return $c;
};
