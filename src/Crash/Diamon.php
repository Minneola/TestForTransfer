<?php

namespace Minneola\TestFoo\Crash;

/**
 * Class Diamon
 * @package Minneola\TestFoo\Crash
 * @author Tobias Maxham <git2015@maxham.de>
 */
class Diamon extends Circle
{

	public function dataSource()
	{
		return $_SERVER;
	}

} 