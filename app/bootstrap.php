<?php

require $config['app']['path'] . '/config/class_alias.php';
require $config['app']['path'] . '/config/config.php';

/**
 * Create Objects
 * 
 * You must set: 
 *   $container
 *   $router
 *   $request
 *   $response
 *   $logger
 *   $templating
 */
// Use Dice as Container
$getContainer = require $config['app']['path'] . '/config/container.dice.php';
$container = new \kenjis\OreOrePHP\Container\Dice($getContainer());

// Use Pimple as Container
//$getContainer = require $config['app']['path'] . '/config/container.pimple.php';
//$container = new \kenjis\OreOrePHP\Container\Pimple($getContainer());

$request   = new \kenjis\OreOrePHP\Request();
$request->fromGlobals();

// Use Pux as Router
$router    = new \kenjis\OreOrePHP\Router\Pux($config['app']['path'], $request);

// Use Phalcon as Router
//$router    = new \kenjis\OreOrePHP\Router\Phalcon($config['app']['path'], $request);

$response  = new \kenjis\OreOrePHP\Response();

// Logger
$logger = $container->resolve('logger');

// Template Engine
$templating = $container->resolve('templating');
