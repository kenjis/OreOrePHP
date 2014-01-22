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
require ROOTPATH . '/config/config.php';

// Below is for Testing Only
define('TESTPATH', __DIR__);

$kernel = \AspectMock\Kernel::getInstance();
$kernel->init([
    'debug'        => true,
    'includePaths' => [ROOTPATH.'/src', ROOTPATH.'/app'],
    'cacheDir'     => ROOTPATH.'/cache/AspectMock',
]);
