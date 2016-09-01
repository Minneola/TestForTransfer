<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

namespace Minneola\TestFoo\Support;

/**
 * Class Manager
 * @package Minneola\TestFoo\Support
 * @author Tobias Maxham <git2015@maxham.de>
 */
class Manager
{
	private $data = [];

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function __get($key)
	{
		if (method_exists($this, 'get' . $key . 'Attribute'))
			return $this->{'get' . $key . 'Attribute'}();
		if (!isset($this->data[$key])) return NULL;
		return $this->data[$key];
	}

	/**
	 * @param string $key
	 * @param mixed $value
	 * @return mixed
	 */
	public function __set($key, $value)
	{
		if (method_exists($this, 'set' . $key . 'Attribute'))
			return $this->{'set' . $key . 'Attribute'}($value);
		return $this->data[$key] = $value;
	}

	/**
	 * @return array $data
	 */
	public function getData()
	{
		return $this->data;
	}
} 