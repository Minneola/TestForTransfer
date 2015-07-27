<?php

namespace Minneola\TestFoo\Core\Arcadia;

/**
 * Class Loader
 * @package Minneola\TestFoo\Core\Arcadia
 * @author Tobias Maxham <git2015@maxham.de>
 */
class Loader
{

	protected static $instance;

	protected $aliases;

	protected $registered = false;

	private function __construct($aliases)
	{
		$this->aliases = $aliases;
	}

	public static function getInstance(array $aliases = array())
	{
		if (is_null(static::$instance)) return static::$instance = new static($aliases);

		$aliases = array_merge(static::$instance->getAliases(), $aliases);

		static::$instance->setAliases($aliases);

		return static::$instance;
	}

	public static function setInstance($loader)
	{
		static::$instance = $loader;
	}

	public function load($alias)
	{
		if (isset($this->aliases[$alias])) {
			return class_alias($this->aliases[$alias], $alias);
		}
	}

	public function alias($class, $alias)
	{
		$this->aliases[$class] = $alias;
	}

	public function register()
	{
		if (!$this->registered) {
			$this->prependToLoaderStack();

			$this->registered = true;
		}
	}

	protected function prependToLoaderStack()
	{
		spl_autoload_register(array($this, 'load'), true, true);
	}

	public function getAliases()
	{
		return $this->aliases;
	}

	public function setAliases(array $aliases)
	{
		$this->aliases = $aliases;
	}

	public function isRegistered()
	{
		return $this->registered;
	}

	public function setRegistered($value)
	{
		$this->registered = $value;
	}

	private function __clone()
	{
		//
	}

}
