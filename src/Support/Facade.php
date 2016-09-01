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
 * Class Facade
 * @package Minneola\TestFoo\Support
 * @author Tobias Maxham <git2015@maxham.de>
 */
class Facade
{
	protected static $app;
	protected static $instance;

	public static function clearAll()
	{
		static::$instance = [];
	}

	public static function setApp($app)
	{
		self::$app = $app;
	}

	public static function __callStatic($method, $args)
	{
		$instance = static::getCls();

		switch (count($args)) {
			case 0:
				return $instance->$method();

			case 1:
				return $instance->$method($args[0]);

			case 2:
				return $instance->$method($args[0], $args[1]);

			case 3:
				return $instance->$method($args[0], $args[1], $args[2]);

			case 4:
				return $instance->$method($args[0], $args[1], $args[2], $args[3]);

			case 5:
				return $instance->$method($args[0], $args[1], $args[2], $args[3], $args[4]);

			default:
				return call_user_func_array(array($instance, $method), $args);
		}
	}

	public static function getCls()
	{
		return static::getInstance(static::getFacadeName());
	}

	public static function getInstance($name)
	{
		if (is_object($name)) return $name;
		if (isset(static::$instance[$name])) return static::$instance[$name];
		return static::$instance[$name] = static::$app[$name];
	}

	/**
	 * @return string
	 * @throws \Exception
	 */
	public static function getFacadeName()
	{
		throw new \Exception('Method getFacadeName not found!');
	}

} 