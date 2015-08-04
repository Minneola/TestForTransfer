<?php

namespace Minneola\TestFoo\Mangold;

use Minneola\TestFoo\Support\SupportManager;

/**
 * Class CainManager
 * @package Minneola\TestFoo\Mangold
 * @author Tobias Maxham <git2015@maxham.de>
 */
class CainManager extends SupportManager
{

	public function call()
	{
		return $this->doIt();
	}

	private function doIt()
	{
		return $this;
	}

} 