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

$config = get_config();

require $config['app']['path'] . '/config/class_alias.php';
require $config['app']['path'] . '/config/config.php';

// Below is for Testing Only
define('TESTPATH', __DIR__);

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug'        => true,
    'includePaths' => [ROOTPATH.'/src', $config['app']['path']],
    'cacheDir'     => $config['app']['path'].'/var/cache/AspectMock',
]);

/**
 * Get Config Instance for Testing
 * 
 * @return \kenjis\OreOrePHP\Config
 */
function get_config()
{
    // Application Namespace
    $config['app']['ns'] = 'App';
    // Application Environment
    $config['app']['env'] = \kenjis\OreOrePHP\Framework::TEST;
    // Path of App/ folder
    $config['app']['path'] = realpath(__DIR__ . '/../App');

    return new \kenjis\OreOrePHP\Config($config);
}
