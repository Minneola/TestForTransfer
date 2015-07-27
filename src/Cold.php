<?php

namespace Minneola\TestFoo;

use Minneola\TestFoo\Crash\Pozer;

/**
 * Class Cold
 * @package Minneola\TestFoo
 * @author Tobias Maxham <git2015@maxham.de>
 */
class Cold extends Pozer
{
	private $luck = 6;

	public function getLuck()
	{
		return $this->luck;
	}

}
