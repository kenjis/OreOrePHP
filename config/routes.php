<?php

// Routing
$mux = new \Pux\Mux();
$mux->add('/:controller/:action/:param0/:param1/:param2', [':dummy',':dummy']);
$mux->add('/:controller/:action/:param0/:param1', [':dummy',':dummy']);
$mux->add('/:controller/:action/:param0', [':dummy',':dummy']);
$mux->add('/:controller/:action', [':dummy',':dummy']);
$mux->add('/:controller', [':dummy',':dummy']);
$mux->add('/', ['Hello','index']);  // top page

return $mux;
