<?php
/**
 * Routing for Phalcon
 */

// Routing
$router = new \Phalcon\Mvc\Router();
$router->add(
    '/:controller/:action/:params',
    array(
        'controller' => 1,
        'action'     => 2,
        'params'     => 3,
    )
);

// top page
$router->add(
    '/',
    array(
        'controller' => 'Hello',
        'action'     => 'index',
    )
);

return $router;
