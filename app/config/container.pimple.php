<?php
/**
 * Service Definitions for Pimple
 * 
 * Documentaion: https://github.com/fabpot/Pimple
 */

return function () use ($config) {
    $c = new \Pimple();

    // Config
    $c['kenjis\OreOrePHP\Config'] = $c->share(function ($c) use ($config) {
        return new kenjis\OreOrePHP\Config($config);
    });

    // Request
    $c['kenjis\OreOrePHP\Request'] = $c->share(function ($c) {
        $request = new kenjis\OreOrePHP\Request;
        $request->fromGlobals();
        return $request;
    });

    // Router
    $c['router'] = $c->share(function ($c) use ($config) {
        return new kenjis\OreOrePHP\Router\Pux(
            $config['app']['path'], $c['kenjis\OreOrePHP\Request']
        );
        //return new kenjis\OreOrePHP\Router\Phalcon(
        //    $config['app']['path'], $c['kenjis\OreOrePHP\Request']
        //);
    });

    // Response
    $c['kenjis\OreOrePHP\Response'] = $c->share(function ($c) {
        return new kenjis\OreOrePHP\Response;
    });

    // Logger (monolog)
    $c['logger'] = $c->share(function ($c) use ($config) {
        $logger = new \Monolog\Logger('app');
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($config['app']['path'] . '/var/log/app.log'));
        return $logger;
    });

    // Templating (Twig)
    $c['templating'] = $c->share(function ($c) use ($config) {
        $loader = new \Twig_Loader_Filesystem($config['app']['path'] . '/views');
        return new \Twig_Environment($loader, ['cache' => $config['app']['path'] . '/var/cache']);
    });

    return $c;
};
