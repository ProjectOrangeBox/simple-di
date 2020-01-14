<?php

require 'di.php';
require 'classA.php';
require 'classB.php';
require 'config.php';

di::factory('a', 'classA');
di::singleton('b', 'classB');
di::singleton('c', 'config');
di::alias('c', 'd');

/* test */
di::get('c')->set('name', 'Don Myers');

di::get('b')->set('Pizza');

var_dump(di::get('c')->get('name'));
var_dump(di::get('b')->get());

di::get('b')->set('Cookies');

var_dump(di::get('b')->get());
var_dump(di::get('d')->get('name'));

$di = di::reference();

var_dump($di->get('d')->get('name'));

var_dump(di::reference());
var_dump(di::reference());
var_dump(di::reference());
var_dump(di::reference());
var_dump(di::reference());
