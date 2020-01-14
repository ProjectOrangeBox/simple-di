<?php

class output extends storage
{
	public $input;

	public function __construct($config, $input)
	{
		$this->storage = $config;
		$this->input = $input;
	}

	public function input()
	{
		return $this->input->collect();
	}
}
