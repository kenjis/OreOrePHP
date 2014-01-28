# OreOrePHP

[![Build Status](https://travis-ci.org/kenjis/OreOrePHP.png)](https://travis-ci.org/kenjis/OreOrePHP)

A simple and fast PHP 5.4+ "glue" framework with minimal learning cost.

## Concepts

* Create your own framework with your favorite components, because you're the best person who knows what you really need.
* Don't depend on a specific framework, because its life might be shorter than your application's life. In fact, even Symfony LTS has only 3 years life.
* Minimize learning cost of your framework. Make it possible that you can start to build your application with the framework today, if you know PHP and how to use your components.

## Using Components

OreOrePHP is using these great components.

* Router
   * [Pux](https://github.com/c9s/Pux) or [Phalcon](https://github.com/phalcon/cphalcon)
* Templating
   * [Twig](https://github.com/fabpot/Twig)
* Container
   * [Dice](https://github.com/Jasrags/Dice) or [Pimple](https://github.com/fabpot/Pimple)
* Logger (PSR-3)
   * [Monolog](https://github.com/Seldaek/monolog)

Testing

* [PHPUnit](https://github.com/sebastianbergmann/phpunit/)
* Mocking
   * [Mockery](https://github.com/padraic/mockery)
   * [AspectMock](https://github.com/Codeception/AspectMock)

## Installation

~~~
$ git clone https://github.com/kenjis/OreOrePHP.git
$ cd OreOrePHP
$ composer install
$ chmod -R 777 app/var
~~~

## URL structure

http://example.com/{foo}[/{bar}[/{param1}[/{param2}[/{param3}]]]]

Above URL excutes `Controller\Foo::actionBar($param1, $param2, $param3)`.

~~~
foo    -> Controller -> Foo class
bar    -> Action     -> actionBar() method
param1 -> 1st param of the method
param2 -> 2nd param of the method
param3 -> 3rd param of the method
~~~

You can also use HTTP method prefixed action in stead of `actionBar()`.

 * `getBar()` in case of GET request
 * `postBar()` in case of POST request

## Convensions

### Controller

* Place in `App/Controller/` folder.
* Namespace must be `App\Controller`.
* PSR-4 autoloading.
* Extend `BaseController`.
* Class name must be ucfirst.
* Function name must be camelCase.
* `actionIndex()` method is the default action.

### Model

* Place in `App/Model/` folder.
* Namespace must be `App\Model`.
* PSR-4 autoloading.

## License

MIT License. See LICENSE file.
