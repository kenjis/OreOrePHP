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

use kenjis\OreOrePHP\Framework;
use kenjis\OreOrePHP\Config;

error_reporting(-1);

define('ROOTPATH', realpath(__DIR__ . '/..'));
define('APPPATH', realpath(__DIR__ . '/../app'));

require ROOTPATH . '/vendor/autoload.php';

$config = new Config();
$config['app']['env'] = 
    isset($_SERVER['ORE_ENV']) ? $_SERVER['ORE_ENV'] : Framework::DEVELOPMENT;

if ($config['app']['env'] === Framework::PRODUCTION) {
    ini_set('display_errors', 0);
} else {
    ini_set('display_errors', 1);
}

require APPPATH . '/bootstrap.php';

$app = new Framework(
    $container, $config, $router, $request, $response, $logger, $templating
);
$app->run();
