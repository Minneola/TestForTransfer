<?php

namespace Minneola\TestFoo\Support\Facades;

use Minneola\TestFoo\Support\Facade;

/**
 * Class App
 * @package Minneola\TestFoo\Support\Facades
 * @author Tobias Maxham <git2015@maxham.de>
 */
class App extends Facade
{
	public static function getFacadeName()
	{
		return 'app';
	}
} 