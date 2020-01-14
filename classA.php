<?php

class classA
{
	protected $name;

	public function get()
	{
		return $this->name;
	}

	public function set(string $name): classA
	{
		$this->name = $name;

		return $this;
	}
} /* end class */
