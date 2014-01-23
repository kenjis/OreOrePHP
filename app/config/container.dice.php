<?php
/**
 * Services Definition for Dice
 * 
 * Documentaition: http://r.je/dice.html
 */

return function () {
    $dice = new \Jasrags\Dice;

    // Templating (Twig)
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'Twig_Loader_Filesystem';
    $rule->constructParams = [APPPATH . '/views'];
    $dice->addRule('Twig_Loader_Filesystem', $rule);
    
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'Twig_Environment';
    $rule->shared = true;
    $rule->constructParams = [[
        'cache' => APPPATH . '/var/cache',
        'auto_reload' => true,
    ]];
    $rule->substitutions['Twig_LoaderInterface'] = 
        new \Jasrags\Dice\Instance('Twig_Loader_Filesystem');
    $dice->addRule('templating', $rule);

    // Logger (monolog)
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'Monolog\Logger';
    $rule->shared = true;
    $rule->constructParams = [
        'app', [new \Monolog\Handler\StreamHandler(APPPATH . '/var/log/app.log')]
    ];
    $dice->addRule('logger', $rule);

    return $dice;
};
