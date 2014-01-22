<?php return Pux\Mux::__set_state(array(
   'routes' => 
  array (
    0 => 
    array (
      0 => true,
      1 => '#^    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
    /(?P<param0>[^/]+?)
    /(?P<param1>[^/]+?)
    /(?P<param2>[^/]+?)
$#xs',
      2 => 
      array (
        0 => ':dummy',
        1 => ':dummy',
      ),
      3 => 
      array (
        'regex' => '    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
    /(?P<param0>[^/]+?)
    /(?P<param1>[^/]+?)
    /(?P<param2>[^/]+?)
',
        'compiled' => '#^    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
    /(?P<param0>[^/]+?)
    /(?P<param1>[^/]+?)
    /(?P<param2>[^/]+?)
$#xs',
        'pattern' => '/:controller/:action/:param0/:param1/:param2',
      ),
    ),
    1 => 
    array (
      0 => true,
      1 => '#^    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
    /(?P<param0>[^/]+?)
    /(?P<param1>[^/]+?)
$#xs',
      2 => 
      array (
        0 => ':dummy',
        1 => ':dummy',
      ),
      3 => 
      array (
        'regex' => '    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
    /(?P<param0>[^/]+?)
    /(?P<param1>[^/]+?)
',
        'compiled' => '#^    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
    /(?P<param0>[^/]+?)
    /(?P<param1>[^/]+?)
$#xs',
        'pattern' => '/:controller/:action/:param0/:param1',
      ),
    ),
    2 => 
    array (
      0 => true,
      1 => '#^    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
    /(?P<param0>[^/]+?)
$#xs',
      2 => 
      array (
        0 => ':dummy',
        1 => ':dummy',
      ),
      3 => 
      array (
        'regex' => '    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
    /(?P<param0>[^/]+?)
',
        'compiled' => '#^    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
    /(?P<param0>[^/]+?)
$#xs',
        'pattern' => '/:controller/:action/:param0',
      ),
    ),
    3 => 
    array (
      0 => true,
      1 => '#^    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
$#xs',
      2 => 
      array (
        0 => ':dummy',
        1 => ':dummy',
      ),
      3 => 
      array (
        'regex' => '    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
',
        'compiled' => '#^    /(?P<controller>[^/]+?)
    /(?P<action>[^/]+?)
$#xs',
        'pattern' => '/:controller/:action',
      ),
    ),
    4 => 
    array (
      0 => true,
      1 => '#^    /(?P<controller>[^/]+?)
$#xs',
      2 => 
      array (
        0 => ':dummy',
        1 => ':dummy',
      ),
      3 => 
      array (
        'regex' => '    /(?P<controller>[^/]+?)
',
        'compiled' => '#^    /(?P<controller>[^/]+?)
$#xs',
        'pattern' => '/:controller',
      ),
    ),
    5 => 
    array (
      0 => false,
      1 => '/',
      2 => 
      array (
        0 => 'Hello',
        1 => 'index',
      ),
      3 => 
      array (
      ),
    ),
  ),
   'staticRoutes' => 
  array (
  ),
   'submux' => 
  array (
  ),
   'id' => NULL,
   'expand' => true,
)); /* version */