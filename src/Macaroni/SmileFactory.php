<?php

namespace Minneola\TestFoo\Macaroni;

/**
 * Class SmileFactory
 * @package Minneola\TestFoo\Macaroni
 * @author Tobias Maxham
 */
class SmileFactory
{

	public function get($path, $callback = NULL)
	{
		\App::setSmile('GET', $path, $callback);
	}

	public function post($path, $callback = NULL)
	{
		\App::setSmile('POST', $path, $callback);
	}

} 