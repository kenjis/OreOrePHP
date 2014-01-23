<?php
/**
 * Services Definition for Dice
 * 
 * Documentaition: http://r.je/dice.html
 */

return function () use ($config) {
    $dice = new \Jasrags\Dice;

    // Templating (Twig)
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'Twig_Loader_Filesystem';
    $rule->constructParams = [$config['app']['path'] . '/views'];
    $dice->addRule('Twig_Loader_Filesystem', $rule);
    
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'Twig_Environment';
    $rule->shared = true;
    $rule->constructParams = [[
        'cache' => $config['app']['path'] . '/var/cache',
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
        'app', [new \Monolog\Handler\StreamHandler($config['app']['path'] . '/var/log/app.log')]
    ];
    $dice->addRule('logger', $rule);

    return $dice;
};
