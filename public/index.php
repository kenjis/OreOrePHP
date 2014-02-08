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

// start profiling
//xhprof_enable();

use kenjis\OreOrePHP\Framework;

error_reporting(-1);

define('ROOTPATH', realpath(__DIR__ . '/..'));
require ROOTPATH . '/vendor/autoload.php';

// Application Namespace
$config['app']['ns'] = 'App';
// Application Environment
$config['app']['env'] = 
    isset($_SERVER['ORE_ENV']) ? $_SERVER['ORE_ENV'] : Framework::DEVELOPMENT;
// Path of App/ folder
$config['app']['path'] = realpath(__DIR__ . '/../App');

if ($config['app']['env'] === Framework::PRODUCTION) {
    ini_set('display_errors', 0);
} else {
    ini_set('display_errors', 1);
}

require $config['app']['path'] . '/bootstrap.php';

$app = new Framework(
    $container, $config, $router, $request, $response, $logger, $templating
);
$app->run();

// stop profiler
//$xhprof_data = xhprof_disable();
//$XHPROF_ROOT = '/opt/lampp/htdocs';
//include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_lib.php";
//include_once $XHPROF_ROOT . "/xhprof_lib/utils/xhprof_runs.php";
//$xhprof_runs = new XHProfRuns_Default();
//$run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_OreOrePHP");
