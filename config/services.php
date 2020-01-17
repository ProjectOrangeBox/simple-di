<?php

return [
	'config' => [
		function () {
			return new config;
		}, true
	],
	'page' => [
		function ($di) {
			return new page($di->config->collect());
		}, false
	],
	'input' => [function ($di) {
		return new input($di->config->collect());
	}, true],
	'output' => [function ($di) {
		return new output($di->config->collect(), $di->input);
	}, true],
];
