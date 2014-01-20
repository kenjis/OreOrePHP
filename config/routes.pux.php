<?php
/**
 * Routing for Pux
 * 
 * config/routes.pux.mux.php is a compiled file of this file.
 * If you want to use mux.php for speed, you must set USE_MAX environment variable.
 * See public/.htaccess.
 * And you must update config/routes.pux.mux.php manually, if you change this file.
 * You can do it with update-mux.sh.
 * 
 * Documentaion: https://github.com/c9s/Pux
 */

// Routing
$mux = new \Pux\Mux();
$mux->add('/:controller/:action/:param0/:param1/:param2', [':dummy',':dummy']);
$mux->add('/:controller/:action/:param0/:param1', [':dummy',':dummy']);
$mux->add('/:controller/:action/:param0', [':dummy',':dummy']);
$mux->add('/:controller/:action', [':dummy',':dummy']);
$mux->add('/:controller', [':dummy',':dummy']);
$mux->add('/', ['Hello','index']);  // top page

return $mux;
