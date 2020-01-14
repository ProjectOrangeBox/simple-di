<?php

class config
{
	protected $config = [];

	public function set($name, $value)
	{
		$this->config[strtolower($name)] = $value;
	}
	public function get($name)
	{
		return $this->config[strtolower($name)] ?? null;
	}
} /* end class */
