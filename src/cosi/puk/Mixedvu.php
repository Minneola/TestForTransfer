<?php

namespace Minneola\TestFoo\Cosi\Puk;

/**
 * Class Mixedvu
 * @package Minneola\TestFoo\Cosi\Puk
 * @author Tobias Maxham <git2015@maxham.de>
 */
trait Mixedvu
{

	public $vi = 65;
	public $roma = FALSE;

	public function getMyNose()
	{
		return $this->$vi * 912;
	}

}
