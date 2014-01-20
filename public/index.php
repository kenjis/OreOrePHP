<?php
/**
 * Part of the OreOrePHP framework.
 *
 * @package    OreOrePHP
 * @version    0.1
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2014 Kenji Suzuki
 * @link       https://github.com/kenjis/OreOrePHP
 */

ini_set('display_errors', 1);
error_reporting(-1);

define('ROOTPATH', realpath(__DIR__ . '/../'));
require ROOTPATH . '/vendor/autoload.php';
require ROOTPATH . '/config/class_alias.php';

// Use Dice as Container
$getContainer = require ROOTPATH . '/config/container.dice.php';
$container = new \kenjis\OreOrePHP\Container\Dice($getContainer());

// Use Pimple as Container
//$getContainer = require ROOTPATH . '/config/container.pimple.php';
//$container = new \kenjis\OreOrePHP\Container\Pimple($getContainer());

$config    = new \kenjis\OreOrePHP\Config();
$request   = new \kenjis\OreOrePHP\Request();
$request->fromGlobals();

// Use Pux as Router
$router    = new \kenjis\OreOrePHP\Router\Pux($request);

// Use Phalcon as Router
//$router    = new \kenjis\OreOrePHP\Router\Phalcon($request);

$response  = new \kenjis\OreOrePHP\Response();

$app = new kenjis\OreOrePHP\Framework(
    $container, $config, $router, $request, $response
);
$app->run();
