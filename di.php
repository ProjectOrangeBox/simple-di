<?php

class di
{
	protected static $alias = [];
	protected static $registered = [];
	protected static $singletonsRef = [];

	public static function reference()
	{
		static $_di;

		if (!$_di) {
			$_di = new di;
		}

		return $_di;
	}

	/**
	 * create a named service alias
	 *
	 * @param string $alias sudo name
	 * @param string $name real service name
	 * @return injector
	 */
	public static function alias(string $name, string $aliasName): void
	{
		self::$alias[strtolower($aliasName)] = strtolower($name);
	}

	/**
	 * Create a Shared service
	 * Once the service is created the same one is always returned
	 *
	 * @param string $name
	 * @param string $object_name
	 * @return injector
	 */
	public static function singleton(string $name, string $className): void
	{
		self::$registered[strtolower($name)] = ['class' => $className, 'singleton' => true];
	}

	/**
	 * Create a service which creates a new instance each time it is requested
	 *
	 * @param string $name
	 * @param string $object_name
	 * @return injector
	 */
	public static function factory(string $name, string $className): void
	{
		self::$registered[strtolower($name)] = ['class' => $className, 'singleton' => false];
	}

	public function has(string $name): bool
	{
		return isset(self::$registered[strtolower($name)]);
	}

	/**
	 * Get a Service
	 *
	 * @param string $name
	 * @return mixed
	 */
	public function get(string $name)
	{
		$name = strtolower($name);

		/* Is this name a alias of another service */
		$name = self::$alias[$name] ?? $name;

		/* Is this service even registered? */
		if (!isset(self::$registered[$name])) {
			/* fatal */
			throw new \Exception($name . ' service not registered.');
		}

		/* By default */
		$object = null;

		/* Is this a singleton or factory? */
		if (self::$registered[$name]['singleton']) {
			/* singleton - has it been created? */
			if (!isset(self::$singletonsRef[$name])) {
				self::$singletonsRef[$name] = new self::$registered[$name]['class'];
			}

			$object = self::$singletonsRef[$name];
		} else {
			/* factory */
			$object = new self::$registered[$name]['class'];
		}

		return $object;
	}
} /* end class */
