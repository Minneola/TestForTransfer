<?php

namespace Minneola\TestFoo\Mangold;

/**
 * Class CainManager
 * @package Minneola\TestFoo\Mangold
 * @author Tobias Maxham <git2015@maxham.de>
 */
class CainManager
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