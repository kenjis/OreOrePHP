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
   * [AspectMock](https://github.com/Codeception/AspectMock)
   * [Mockery](https://github.com/padraic/mockery)

## Installation

~~~
$ git clone https://github.com/kenjis/OreOrePHP.git
$ cd OreOrePHP
$ composer install
$ chmod 777 cache
~~~

## URL structure

http://example.com/{foo}[/{bar}[/{param1}[/{param2}[/{param3}]]]]

~~~
foo    -> controller name -> Foo class
bar    -> action method   -> actionBar() function
param1 -> 1st param of the method
param2 -> 2nd param of the method
param3 -> 3rd param of the method
~~~

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
