<?php

require __DIR__ . '/bootstrap.php';

/* test stuff */

/* use it like this using the wrapper */
$config = di('config');

$config->set('name', 'Don Myers');
$config->set('age', 21);

/* or this if you have a reference */
$input = di('input');

$input->show('$input');

$input->set('food', 'Pizza');

$input->show('$input');

$input2 = di('input');

$input2->show('$input2');

di()->register('chow', function () {
	return ['name' => 'just an array', 'pet' => 'dog'];
});

var_dump('chow returns an array', di('chow'));

$page1 = di('page');

$page1->set('title', 'this is the title');

$page2 = di('page');

$page2->set('title', 'this is the title of page 2');

$page1->show('$page1');
$page2->show('$page2');

$output = di('output');

$output->input->show('$output->input');
