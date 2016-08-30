<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

namespace Minneola\TestFoo\Core\Arcadia;

/**
 * Class Loader
 * @package Minneola\TestFoo\Core\Arcadia
 * @author Tobias Maxham <git2015@maxham.de>
 */
/**
 * Class Loader
 * @package Minneola\TestFoo\Core\Arcadia
 */
class Loader
{

    /**
     * @var
     */
    protected static $instance;

    /**
     * @var
     */
    protected $aliases;

    /**
     * @var bool
     */
    protected $registered = false;

    /**
     * Loader constructor.
     * @param $aliases
     */
    private function __construct($aliases)
	{
		$this->aliases = $aliases;
	}

    /**
     * @param array $aliases
     * @return static
     */
    public static function getInstance(array $aliases = array())
	{
		if (is_null(static::$instance)) return static::$instance = new static($aliases);

		$aliases = array_merge(static::$instance->getAliases(), $aliases);

		static::$instance->setAliases($aliases);

		return static::$instance;
	}

    /**
     * @param $loader
     */
    public static function setInstance($loader)
	{
		static::$instance = $loader;
	}

    /**
     * @param $alias
     * @return bool
     */
    public function load($alias)
	{
		if (isset($this->aliases[$alias])) {
			return class_alias($this->aliases[$alias], $alias);
		}
	}

    /**
     * @param $class
     * @param $alias
     */
    public function alias($class, $alias)
	{
		$this->aliases[$class] = $alias;
	}

    /**
     *
     */
    public function register()
	{
		if (!$this->registered) {
			$this->prependToLoaderStack();

			$this->registered = true;
		}
	}

    /**
     *
     */
    protected function prependToLoaderStack()
	{
		spl_autoload_register(array($this, 'load'), true, true);
	}

    /**
     * @return mixed
     */
    public function getAliases()
	{
		return $this->aliases;
	}

    /**
     * @param array $aliases
     */
    public function setAliases(array $aliases)
	{
		$this->aliases = $aliases;
	}

    /**
     * @return bool
     */
    public function isRegistered()
	{
		return $this->registered;
	}

    /**
     * @param $value
     */
    public function setRegistered($value)
	{
		$this->registered = $value;
	}

    /**
     *
     */
    private function __clone()
	{
		//
	}

}
