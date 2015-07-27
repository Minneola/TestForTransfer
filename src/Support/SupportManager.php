<?php

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