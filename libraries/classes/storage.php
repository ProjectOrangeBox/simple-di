<?php

class storage
{
	protected $storage;

	public function __construct($config = null)
	{
		if (is_array($config)) {
			$this->storage = $config;
		}
	}

	public function get(string $key)
	{
		return $this->storage[strtolower($key)] ?? null;
	}

	public function set(string $key, $value): void
	{
		$this->storage[strtolower($key)] = $value;
	}

	public function show(string $header): void
	{
		echo '** ' . $header . ' **' . PHP_EOL . '"' . get_called_class() . '"'  . PHP_EOL . print_r($this->storage, true);
	}

	public function collect(): array
	{
		return $this->storage;
	}
} /* end class */
