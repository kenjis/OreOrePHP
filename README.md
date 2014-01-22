# OreOrePHP

[![Build Status](https://travis-ci.org/kenjis/OreOrePHP.png)](https://travis-ci.org/kenjis/OreOrePHP)

A simple and fast PHP 5.4+ "glue" framework with minimal learning cost.

## Using Components

OreOrePHP is using these great components.

* Router
   * [Pux](https://github.com/c9s/Pux) or [Phalcon](https://github.com/phalcon/cphalcon)
* Templating
   * [Twig](https://github.com/fabpot/Twig)
* Container
   * [Dice](https://github.com/Jasrags/Dice) or [Pimple](https://github.com/fabpot/Pimple)

Testing

* Mocking
   * [Mockery](https://github.com/padraic/mockery)
   * [AspectMock](https://github.com/Codeception/AspectMock)

## Installation

~~~
$ git clone https://github.com/kenjis/OreOrePHP.git
$ cd OreOrePHP
$ composer install
$ chmod 777 app/cache
~~~

## URL structure

http://example.com/{foo}[/{bar}[/{param1}[/{param2}[/{param3}]]]]

Above URL excutes `Controller\Foo::actionBar($param1, $param2, $param3)`.

~~~
foo    -> Controller -> Foo class
bar    -> Action     -> actionBar() function
param1 -> 1st param of the method
param2 -> 2nd param of the method
param3 -> 3rd param of the method
~~~

You can also use HTTP method prefixed action in stead of actionBar().

 * getBar() in case GET request
 * postBar() in case POST request

## Convension

### Controller

* Place in `app/controller/` folder.
* PSR-4 autoloading.
* Namespace must be `Controller`.
* Extend BaseController.
* Class name must be ucfirst.
* Function name must be camelCase.
* actionIndex() method is the default action.

### Model

* Place in `app/models/` folder.
* PSR-4 autoloading.
* Namespace must be `Model`.

## License

MIT License. See LICENSE file.
