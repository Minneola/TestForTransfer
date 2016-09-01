<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

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