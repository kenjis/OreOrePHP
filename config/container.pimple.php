<?php
/**
 * Service Definition for Pimple
 * 
 * Documentaion: https://github.com/fabpot/Pimple
 */

return function () {
    $c = new \Pimple();
    
    // Templating (Twig)
    $c['templating'] = $c->share(function ($c) {
        $loader = new \Twig_Loader_Filesystem(ROOTPATH . '/app/views');
        return new \Twig_Environment($loader, ['cache' => ROOTPATH . '/cache']);
    });
    
    return $c;
};
