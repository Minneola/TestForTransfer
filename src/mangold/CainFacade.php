<?php

namespace Minneola\TestFoo\Mangold;

/**
 * Class CainFacade
 * @package Minneola\TestFoo\Mangold
 * @author Tobias Maxham
 * @version 26.07.2015
 */
class CainFacade
{

	protected static $app;
	protected static $resolvedInstance;


	public static function clearResolvedInstances()
	{
		static::$resolvedInstance = array();
	}

	public static function getFacadeRoot()
	{

		return static::resolveFacadeInstance(static::getFacadeAccessor());
	}

	public static function setFacadeApplication($app)
	{
		self::$app = $app;
	}

	public static function swap()
	{
		var_dump('sdds');
	}

	public static  function resolveFacadeInstance($name)
	{

		if (is_object($name)) return $name;

		if (isset(static::$resolvedInstance[$name]))
		{
			return static::$resolvedInstance[$name];
		}

		return static::$resolvedInstance[$name] = static::$app[$name];
	}

	public static  function getFacadeAccessor()
	{
		return 'cain';
	}


	public static function __callStatic($method, $args)
	{
		$instance = static::getFacadeRoot();

		switch (count($args))
		{
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

			default:
				return call_user_func_array(array($instance, $method), $args);
		}
	}


} 