<?php

require $config['app']['path'] . '/config/class_alias.php';
require $config['app']['path'] . '/config/config.php';

/**
 * Create Objects
 * 
 * You must set: 
 *   $container
 *   $config
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

$config   = $container->get('kenjis\OreOrePHP\Config');
$request  = $container->get('kenjis\OreOrePHP\Request');
$router   = $container->get('router');
$response = $container->get('kenjis\OreOrePHP\Response');

// Logger
$logger = $container->get('logger');

// Template Engine
$templating = $container->get('templating');
