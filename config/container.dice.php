<?php

return function () {
    $dice = new \Jasrags\Dice;

    // Twig
    $rule1 = new \Jasrags\Dice\Rule;
    $rule1->instanceOf = 'Twig_Loader_Filesystem';
    $rule1->constructParams = [__DIR__ . '/../app/views'];
    $dice->addRule('$MyTwig_Loader_Filesystem', $rule1);
    $rule2 = new \Jasrags\Dice\Rule;
    $rule2->shared = true;
    $rule2->constructParams = [['cache' => __DIR__ . '/../cache']];
    $rule2->substitutions['Twig_LoaderInterface'] = new \Jasrags\Dice\Instance('$MyTwig_Loader_Filesystem');
    $dice->addRule('Twig_Environment', $rule2);

    return $dice;
};
