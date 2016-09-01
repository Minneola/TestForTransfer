<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

namespace Minneola\TestFoo\Support;

/**
 * Class SupportManager
 * @package Minneola\TestFoo\Support
 * @author Tobias Maxham <git2015@maxham.de>
 */
class SupportManager extends Manager
{
	public function __construct()
	{
		$this->className = get_class($this);
	}

	public function __toString()
	{
		return implode(', ', $this->getData());
	}

} 