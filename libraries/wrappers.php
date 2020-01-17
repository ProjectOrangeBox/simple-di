<?php

if (!function_exists('di')) {
	function di($serviceName = null)
	{
		static $di;

		if (!$di) {
			$di = (is_array($serviceName)) ? new di($serviceName) : new di;

			$serviceName = null;
		}

		return ($serviceName) ? $di->get($serviceName) : $di;
	}
}
