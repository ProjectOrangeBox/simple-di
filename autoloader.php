<?php

/* register a simple autoload loader for the example */
spl_autoload_register(function ($class) {
	include __DIR__ . '/classes/' . $class . '.php';
});
