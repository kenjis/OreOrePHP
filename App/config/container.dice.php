<?php
/**
 * Service Definitions for Dice
 * 
 * Documentaition: http://r.je/dice.html
 */

return function () use ($config) {
    $dice = new \Jasrags\Dice;

    // Config
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'kenjis\OreOrePHP\Config';
    $rule->shared = true;
    $rule->constructParams = [$config];
    $dice->addRule('kenjis\OreOrePHP\Config', $rule);

    // Request
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'kenjis\OreOrePHP\Request';
    $rule->shared = true;
    $rule->call[] = array('fromGlobals', []);
    $dice->addRule('kenjis\OreOrePHP\Request', $rule);

    // Router
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'kenjis\OreOrePHP\Router\Pux';
    //$rule->instanceOf = 'kenjis\OreOrePHP\Router\Phalcon';
    $rule->shared = true;
    $rule->constructParams = [
        $config['app']['path'],
        new \Jasrags\Dice\Instance('kenjis\OreOrePHP\Request')
    ];
    $dice->addRule('router', $rule);

    // Response
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'kenjis\OreOrePHP\Response';
    $rule->shared = true;
    $dice->addRule('kenjis\OreOrePHP\Response', $rule);

    // Logger (monolog)
    $rule = new \Jasrags\Dice\Rule;
    $rule->instanceOf = 'Monolog\Logger';
    $rule->shared = true;
    $rule->constructParams = [
        'app', [new \Monolog\Handler\StreamHandler($config['app']['path'] . '/var/log/app.log')]
    ];
    $dice->addRule('logger', $rule);

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

    return $dice;
};
