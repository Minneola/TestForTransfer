<?php

namespace Minneola\TestFoo\Core;

use Minneola\TestFoo\Core\Arcadia\Loader;
use Minneola\TestFoo\Support\Facade;

/**
 * Class Application
 * @package Minneola\TestFoo\Core
 * @author Tobias Maxham
 */
class Application implements \ArrayAccess
{

	private static $app;
	private $instances = [];

	protected $aliases = [
		'cain' => 'Minneola\\TestFoo\\Mangold\\CainManager',
	];

	public static function boot()
	{
		self::$app = new Application();
		self::initiate();
		return self::$app;
	}

	private static function initiate()
	{
		Facade::clearAll();
		Facade::setApp(self::$app);
		Loader::getInstance(self::$app->getAliases())->register();
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
		return require __DIR__.'/../../aliases.php';
	}

	public function alias()
	{
		foreach ($this->getAliases() as $alias => $class) {
			class_alias($class, $alias);
		}
	}

	public function offsetExists($key)
	{
		return isset($this->aliases[$key]);
	}

	public function offsetGet($key)
	{
		return $this->make($key);
	}

	public function make($abstract)
	{
		$abstract = $this->getAlias($abstract);
		return new $abstract;
	}

	protected function getAlias($abstract)
	{
		return isset($this->aliases[$abstract]) ? $this->aliases[$abstract] : $abstract;
	}

	public function offsetSet($key, $value)
	{
		if (!$value instanceof \Closure) {
			$value = function () use ($value) {
				return $value;
			};
		}
		$this->instances[$key] = $value;
	}

	public function offsetUnset($key)
	{
		unset($this->instances[$key]);
	}

} 