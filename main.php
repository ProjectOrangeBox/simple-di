<?php

require __DIR__ . '/autoloader.php';

function di($serviceName = null)
{
	static $di;

	if (!$di) {
		if (!is_array($serviceName)) {
			throw new Exception('Please provide the services configuration before using the dependency injector.');
		} else {
			$di = new di($serviceName);

			$serviceName = null;
		}
	}

	return ($serviceName) ? $di->get($serviceName) : $di;
}

$services = require __DIR__ . '/services.php';

/* set up */
$di = di($services);

/* test stuff */
$config = di('config');

$config->set('name', 'Don Myers');
$config->set('age', 21);

$input = $di->input;

$input->show('$input');

$input->set('food', 'Pizza');

$input->show('$input');

$input2 = $di->input;

$input2->show('$input2');

$di->register('chow', function () {
	return ['name' => 'just an array', 'pet' => 'dog'];
});

var_dump('chow returns an array', $di->chow);

$page1 = $di->page;

$page1->set('title', 'this is the title');

$page2 = $di->page;

$page2->set('title', 'this is the title of page 2');

$page1->show('$page1');
$page2->show('$page2');

$output = $di->output;

$output->input->show('$output->input');
