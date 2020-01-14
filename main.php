<?php

/* register a simple autoload loader for the example */
spl_autoload_register(function ($class) {
	include __DIR__ . '/classes/' . $class . '.php';
});

/* register config service */
di::register('config', function () {
	return new config;
}, true);

/* register page service this should be a new instance each time it's requested */
di::register('page', function () {
	return new page(di::get('config')->collect());
}, false);

/* register a input and output service */
di::register('input', function () {
	return new input(di::get('config')->collect());
}, true);

di::register('output', function () {
	return new output(di::get('config')->collect(), di::get('input'));
}, true);

$config = di::get('config');

$config->set('name', 'Don Myers');
$config->set('age', 21);

$input = di::get('input');

$input->show('$input');

$input->set('food', 'Pizza');

$input->show('$input');

$input2 = di::get('input');

$input2->show('$input2');

di::register('chow', function () {
	return ['name' => 'just an array', 'pet' => 'dog'];
});

var_dump('chow returns an array', di::get('chow'));

$page1 = di::get('page');

$page1->set('title', 'this is the title');

$page2 = di::get('page');

$page2->set('title', 'this is the title of page 2');

$page1->show('$page1');
$page2->show('$page2');

$output = di::get('output');

$output->input->show('$output->input');

//var_dump(di::debug());
