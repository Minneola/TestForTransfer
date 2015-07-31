<?php

namespace Minneola\TestFoo\Bread;

/**
 * Class StaleBread
 * @package Minneola\TestFoo\Bread
 * @author Tobias Maxham
 */
class StaleBread
{

	private $data = [];

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function __get($key)
	{
		$method = 'get'.ucfirst($key).'Attribute';
		if(method_exists($this, $method)) return $this->{$method}();
		if(!isset($this->data[strtolower($key)])) return NULL;
		return $this->data[strtolower($key)];
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 * @return NULL
	 */
	public function __set($key, $value)
	{
		$method = 'set'.ucfirst($key).'Attribute';
		if(method_exists($this, $method)) return $this->{$method}($value);
		return $this->data[$key] = $value;
	}

} 