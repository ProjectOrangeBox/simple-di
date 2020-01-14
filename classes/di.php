<?php

class di
{
	/**
	 * Registered Services
	 *
	 * @var array
	 */
	protected static $registeredServices = [];

	/**
	 * Register a new service as a singleton or factory
	 *
	 * @param string $serviceName
	 * @param closure $closure
	 * @param bool $singleton
	 * @return void
	 */
	public static function register(string $serviceName, closure $closure, bool $singleton = false): void
	{
		self::$registeredServices[strtolower($serviceName)] = ['closure' => $closure, 'singleton' => $singleton, 'reference' => null];
	}

	/**
	 * Check whether the Service been registered
	 *
	 * @param string $serviceName
	 * @return bool
	 */
	public static function has(string $serviceName): bool
	{
		return isset(self::$registeredServices[strtolower($serviceName)]);
	}

	/**
	 * Get a PHP object by service name
	 *
	 * @param string $serviceName
	 * @return mixed
	 */
	public static function get(string $serviceName)
	{
		$serviceName = strtolower($serviceName);

		/* Is this service even registered? */
		if (!isset(self::$registeredServices[$serviceName])) {
			/* fatal */
			throw new \Exception($serviceName . ' service not registered.');
		}

		/* Is this a singleton or factory? */
		return (self::$registeredServices[$serviceName]['singleton']) ? self::singleton($serviceName) : self::make($serviceName);
	}

	/**
	 * Get the same instance of a service
	 *
	 * @param string $serviceName
	 * @return mixed
	 */
	protected static function singleton(string $serviceName)
	{
		return self::$registeredServices[$serviceName]['reference'] ?? self::$registeredServices[$serviceName]['reference'] = self::make($serviceName);
	}

	/**
	 * Get instance of a service
	 *
	 * @param string $serviceName
	 * @return mixed
	 */
	protected static function make(string $serviceName)
	{
		return self::$registeredServices[$serviceName]['closure']();
	}

	/**
	 * returns a debug array
	 *
	 * @return array
	 */
	public static function debug(): array
	{
		$debug = [];

		foreach (self::$registeredServices as $key => $record) {
			$debug[$key] = ['singleton' => ($record['singleton']), 'attached' => isset(self::$registeredServices[$key]['reference'])];
		}

		return $debug;
	}
} /* end class */
