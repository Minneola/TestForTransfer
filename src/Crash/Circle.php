<?php

namespace Minneola\TestFoo\Crash;

/**
 * Class Circle
 * @package Minneola\TestFoo\Crash
 * @author Tobias Maxham <git2015@maxham.de>
 */
class Circle
{

	private $data;

	public function __construct()
	{
		$this->data = $this->dataSource();
	}

	/**
	 * @reutrn array $data
	 * @throws \Exception
	 */
	protected function dataSource()
	{
		throw new \Exception('Method dtaSource not exists.');
	}

	public function __get($key)
	{
		if(!isset($this->data[strtoupper($key)])) return NULL;
		return $this->data[strtoupper($key)];
	}

} 