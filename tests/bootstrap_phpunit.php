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
define('APPPATH', realpath(__DIR__ . '/../app'));

require ROOTPATH . '/vendor/autoload.php';
require APPPATH . '/config/class_alias.php';
require APPPATH . '/config/config.php';

// Below is for Testing Only
define('TESTPATH', __DIR__);

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug'        => true,
    'includePaths' => [ROOTPATH.'/src', APPPATH],
    'cacheDir'     => APPPATH.'/cache/AspectMock',
]);
