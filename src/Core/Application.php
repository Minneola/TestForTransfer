<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

namespace Minneola\TestFoo\Core;

use Minneola\TestFoo\Core\Arcadia\Loader;
use Minneola\TestFoo\Crash\Diamon;
use Minneola\TestFoo\Support\Facade;

/**
 * Class Application
 * @package Minneola\TestFoo\Core
 * @author Tobias Maxham
 */
class Application implements \ArrayAccess
{

    /**
     * @var Application
     */
    public static $app;
    /**
     * @var array
     */
    public static $smiles = ['GET' => [], 'POST' => []];

    /**
     * @var array
     */
    private $instances = [];

    /**
     * @var null
     */
    private $rootPath;

    /**
     * @var array
     */
    protected $aliases = [
		'app' => 'Minneola\\TestFoo\\Core\\Application',
		'cain' => 'Minneola\\TestFoo\\Mangold\\CainManager',
		'file' => 'Minneola\\TestFoo\\Fichier\\Fichier',
		'smile' => 'Minneola\\TestFoo\\Macaroni\\SmileFactory',
		'pod' => 'Minneola\\TestFoo\\Pod\\Podanie',
	];

    /**
     * @var array
     */
    private $defaultAliases = [
        'App' => 'Minneola\\TestFoo\\Support\\Facades\\App',
        'Cain' => 'Minneola\\TestFoo\\Support\\Facades\\Cain',
        'Smile' => 'Minneola\\TestFoo\\Support\\Facades\\Smile',
    ];

    /**
     * Application constructor.
     * @param null $path
     */
    public function __construct($path = NULL)
	{
		if (isset(self::$app)) {
			$this->rootPath = self::app()->rootPath();
		} else {

			$this->rootPath = $path;
		}
		self::$app = &$this;
		return self::$app;
	}

    /**
     * @return null
     */
    public function rootPath()
	{
		return $this->rootPath;
	}

    /**
     * @return string
     */
    public function viewPath()
	{
		return __DIR__ . '/../../../../../views/';
	}

    /**
     * @return Application
     */
    public static function app()
	{
		return self::$app;
	}

    /**
     * @return array
     */
    public static function smiles()
	{
		$app = self::app();
		return $app::$smiles;
	}

    /**
     * @param $method
     * @param $path
     * @param null $attributes
     */
    public static function setSmile($method, $path, $attributes = NULL)
	{
		self::$smiles[$method][$path] = [$path, $attributes];
	}

    /**
     * @return $this
     */
    public function boot()
	{
		$this->initiate();
		$this->loadSmiles();
		return $this;
	}

    /**
     * @return bool|mixed|null
     */
    public function run()
	{
		$data = new Diamon();
		$url = $data->request_uri;
		$method = $data->request_method;

		if (($ctr = $this->checkExistingSmiles($url, $method)) !== FALSE) return $ctr;
		if (($ctr = $this->checkExistingSmiles(substr($url, 1), $method)) !== FALSE) return $ctr;
		return NULL;
	}

    /**
     * @param $url
     * @param $method
     * @return bool|mixed
     * @throws \Exception
     */
    private function checkExistingSmiles($url, $method)
	{
		if (!array_key_exists($url, \App::smiles()[$method])) return FALSE;
		if (\App::smiles()[$method][$url][1] instanceof \Closure)
			return call_user_func(\App::smiles()[$method][$url][1]);

		$st = explode('@', \App::smiles()[$method][$url][1]);
		if (count($st) != 2) throw new \Exception('Wrong controller declaration.');

		$realController = 'App\\Controller\\' . $st[0];

		$init = new $realController(\App::getApp());
		$init->setControllerAction($st[1]);
		return $init;
	}

    /**
     *
     */
    private function initiate()
	{
		Facade::clearAll();
		Facade::setApp($this);
		Loader::getInstance($this->getAllAliases())->register();
	}

	/**
	 * @return \Minneola\TestFoo\Core\Application
	 */
	public static function getApp()
	{
		return self::$app;
	}

    /**
     * @return array
     */
    protected function getAllAliases()
    {
        $setup = $this->getAliases();
        $basic = $this->defaultAliases;
        return array_merge($setup, $basic);
    }

    /**
     * @throws \Exception
     */
    private function loadSmiles()
	{
		$file = $this->rootPath . '/app/smiles.php';
		if (!file_exists($file)) throw new \Exception("The File $file was not found!");
		require_once $file;
	}

	/**
	 * @return array $aliases
	 */
	public function getAliases()
	{
	    $file = $this->rootPath . '/config/setup.php';
        if(!file_exists($file)) return [];
		return require $file;
	}

    /**
     *
     */
    public function alias()
	{
		foreach ($this->getAliases() as $alias => $class) {
			class_alias($class, $alias);
		}
	}

    /**
     * @param mixed $key
     * @return bool
     */
    public function offsetExists($key)
	{
		return isset($this->aliases[$key]);
	}

    /**
     * @param mixed $key
     * @return mixed
     */
    public function offsetGet($key)
	{
		return $this->make($key);
	}

    /**
     * @param $abstract
     * @return mixed
     */
    public function make($abstract)
	{
		$abstract = $this->getAlias($abstract);
		return new $abstract;
	}

    /**
     * @param $abstract
     * @return mixed
     */
    protected function getAlias($abstract)
	{
		return isset($this->aliases[$abstract]) ? $this->aliases[$abstract] : $abstract;
	}

    /**
     * @param mixed $key
     * @param mixed $value
     */
    public function offsetSet($key, $value)
	{
		if (!$value instanceof \Closure) {
			$value = function () use ($value) {
				return $value;
			};
		}
		$this->instances[$key] = $value;
	}

    /**
     * @param mixed $key
     */
    public function offsetUnset($key)
	{
		unset($this->instances[$key]);
	}

} 
