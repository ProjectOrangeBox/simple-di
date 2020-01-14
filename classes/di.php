<?php

class di
{
	/**
	 * Registered Services
	 *
	 * @var array
	 */
	protected $registeredServices = [];

	public function __construct(array $serviceArray = null)
	{
		if ($serviceArray) {
			foreach ($serviceArray as $serviceName => $closureSingleton) {
				$this->register($serviceName, $closureSingleton[0], $closureSingleton[1]);
			}
		}
	}

	/**
	 * Register a new service as a singleton or factory
	 *
	 * @param string $serviceName
	 * @param closure $closure
	 * @param bool $singleton
	 * @return void
	 */
	public function register(string $serviceName, closure $closure, bool $singleton = false): void
	{
		$this->registeredServices[strtolower($serviceName)] = ['closure' => $closure, 'singleton' => $singleton, 'reference' => null];
	}

	public function __get($name)
	{
		return $this->get($name);
	}

	public function __isset($name)
	{
		return $this->has($name);
	}

	public function __set($name, $value)
	{
		$this->register($name, $value[0], $value[1]);
	}

	/**
	 * Check whether the Service been registered
	 *
	 * @param string $serviceName
	 * @return bool
	 */
	public function has(string $serviceName): bool
	{
		return isset($this->registeredServices[strtolower($serviceName)]);
	}

	/**
	 * Get a PHP object by service name
	 *
	 * @param string $serviceName
	 * @return mixed
	 */
	public function get(string $serviceName)
	{
		$serviceName = strtolower($serviceName);

		/* Is this service even registered? */
		if (!isset($this->registeredServices[$serviceName])) {
			/* fatal */
			throw new \Exception($serviceName . ' service not registered.');
		}

		/* Is this a singleton or factory? */
		return ($this->registeredServices[$serviceName]['singleton']) ? self::singleton($serviceName) : self::make($serviceName);
	}

	/**
	 * Get the same instance of a service
	 *
	 * @param string $serviceName
	 * @return mixed
	 */
	protected function singleton(string $serviceName)
	{
		return $this->registeredServices[$serviceName]['reference'] ?? $this->registeredServices[$serviceName]['reference'] = self::make($serviceName);
	}

	/**
	 * Get instance of a service
	 *
	 * @param string $serviceName
	 * @return mixed
	 */
	protected function make(string $serviceName)
	{
		return $this->registeredServices[$serviceName]['closure']($this);
	}

	/**
	 * returns a debug array
	 *
	 * @return array
	 */
	public function debug(): array
	{
		$debug = [];

		foreach ($this->registeredServices as $key => $record) {
			$debug[$key] = ['singleton' => $record['singleton'], 'attached' => isset($this->registeredServices[$key]['reference'])];
		}

		return $debug;
	}
} /* end class */
