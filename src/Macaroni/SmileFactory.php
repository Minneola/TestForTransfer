<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

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