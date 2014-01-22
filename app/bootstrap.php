<?php

require ROOTPATH . '/config/class_alias.php';
require ROOTPATH . '/config/config.php';

/**
 * Create Objects
 * 
 * You must set: 
 *   $container
 *   $router
 *   $request
 *   $response
 *   $templating
 */
// Use Dice as Container
$getContainer = require ROOTPATH . '/config/container.dice.php';
$container = new \kenjis\OreOrePHP\Container\Dice($getContainer());

// Use Pimple as Container
//$getContainer = require ROOTPATH . '/config/container.pimple.php';
//$container = new \kenjis\OreOrePHP\Container\Pimple($getContainer());

$request   = new \kenjis\OreOrePHP\Request();
$request->fromGlobals();

// Use Pux as Router
$router    = new \kenjis\OreOrePHP\Router\Pux($request);

// Use Phalcon as Router
//$router    = new \kenjis\OreOrePHP\Router\Phalcon($request);

$response  = new \kenjis\OreOrePHP\Response();

// Template Engine
$templating = $container->resolve('templating');
