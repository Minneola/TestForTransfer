<?php

namespace Minneola\TestFoo\Core;

use Minneola\TestFoo\Core\Arcadia\Project;

/**
 * Class Application
 * @package Minneola\TestFoo\Core
 * @author Tobias Maxham
 */
class Application
{
	private static $app;

	public $test = [];

	public static function boot()
	{
		self::$app = new Project();


		self::$app->test['App'] = new Application();



		return self::$app;
	}

} 