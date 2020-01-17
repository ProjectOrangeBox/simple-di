<?php

if (!function_exists('di')) {
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
}
