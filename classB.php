<?php

class classB
{
	protected $name;

	public function get()
	{
		return $this->name;
	}

	public function set(string $name): classB
	{
		$this->name = $name;

		return $this;
	}
} /* end class */
