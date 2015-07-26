<?php

namespace Minneola\TestFoo\Core;

use Minneola\TestFoo\Core\Arcadia\Loader;
use Minneola\TestFoo\Core\Arcadia\Project;
use Minneola\TestFoo\Mangold\CainFacade;

/**
 * Class Application
 * @package Minneola\TestFoo\Core
 * @author Tobias Maxham
 */
class Application implements \ArrayAccess
{
	private static $app;

	public $test = [];

	protected $aliases = [
		'cain' => 'Minneola\\TestFoo\\Mangold\\CainManager',
	];

	public static function boot()
	{
		self::$app = new Project();


		$app = new Application();
		self::getApp()->test['App'] = $app;



		CainFacade::clearResolvedInstances();

		CainFacade::setFacadeApplication($app);
		Loader::getInstance($app->getAliases())->register();

		//self::getApp()->test['App']->alias();

		return self::$app;
	}

	public function alias()
	{
		foreach($this->getAliases() as $alias => $class) {
			class_alias($class, $alias);
		}
	}

	/**
	 * @return \Minneola\TestFoo\Core\Application
	 */
	public static function getApp()
	{
		return self::$app;
	}

	/**
	 * @return array $aliases
	 */
	public function getAliases()
	{
		return [
			'Cain' => '\\Minneola\\TestFoo\\Mangold\\CainFacade',
		];
	}



	public function offsetExists($key)
	{
		return isset($this->bindings[$key]);
	}

	public function offsetGet($key)
	{
		return $this->make($key);
	}

	public function offsetSet($key, $value)
	{
		if ( ! $value instanceof Closure)
		{
			$value = function() use ($value)
			{
				return $value;
			};
		}

		$this->bind($key, $value);
	}


	public function offsetUnset($key)
	{
		unset($this->bindings[$key], $this->instances[$key]);
	}


	protected function getAlias($abstract)
	{
		return isset($this->aliases[$abstract]) ? $this->aliases[$abstract] : $abstract;
	}

	/**
	 * Resolve the given type from the container.
	 *
	 * (Overriding Container::make)
	 *
	 * @param  string  $abstract
	 * @param  array   $parameters
	 * @return mixed
	 */
	public function make($abstract, $parameters = array())
	{
		$abstract = $this->getAlias($abstract);
		return new $abstract;
	}

} 