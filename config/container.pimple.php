<?php

return function () {
    $c = new \Pimple();
    
    // Twig
    $c['Twig_Environment'] = $c->share(function ($c) {
        $loader = new \Twig_Loader_Filesystem(ROOTPATH . '/app/views');
        return new \Twig_Environment($loader, ['cache' => ROOTPATH . '/cache']);
    });
    
    return $c;
};
