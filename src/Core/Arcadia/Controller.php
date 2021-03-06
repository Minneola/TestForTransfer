<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

namespace Minneola\TestFoo\Core\Arcadia;
use Minneola\TestFoo\Akinator\Parser;

/**
 * Class Controller
 * @package Minneola\TestFoo\Core\Arcadia
 * @author Tobias Maxham <git2015@maxham.de>
 */
class Controller
{

	private $app;
	private $lawyer = NULL;
	private $action = NULL;

	private $tokens = [];
	private $vars = [];

	protected $parser = ['{_', '_}'];

	public function __construct($app = NULL)
	{
		$this->app = $app;
	}

	protected function addToken($key, $value)
	{
		$this->tokens[strtolower($key)] = $value;
	}

	protected function addVar($key, $value)
	{
		$this->vars[strtolower($key)] = $value;
	}

	public function lyer($lawyer = NULL)
	{
		if(!is_null($lawyer)) $this->lawyer = $lawyer;
		return $this->lawyer;
	}

	public function __toString()
	{
		$this->{$this->action}();
		return $this->compileHTML();
	}

	private function compileHTML()
	{
		$code = $this->parseHTML();

		return $this->compileEscapedEchos($code);
	}

	protected function compileEscapedEchos($value)
	{
		//TODO-tmaxham: bin kein experte =D
		$pattern = sprintf('/%s\s*(.+?)\s*%s(\r?\n)?/s', $this->parser[0], $this->parser[1]);
		$callback = function ($matches) {
			$token = strtolower($matches[1]);
			return isset($this->tokens[$token]) ? $this->tokens[$token] : '';
		};
		return preg_replace_callback($pattern, $callback, $value);
	}

	/**
	 * @return \Minneola\TestFoo\Core\Application $app
	 */
	protected function app()
	{
		return $this->app;
	}

	private function parseHTML()
	{
		$c = file_get_contents( $this->app()->viewPath() .$this->lawyer.'.php');

		try{
			return $this->doParseTemplate($c);
		} catch(\Exception $e){
			echo $e->getMessage();
			return '';
		}
	}

	private function doParseTemplate($badCode)
	{
		ob_start ();

		foreach($this->vars as $key => $value) $$key = $value;

		$code = new Parser($badCode);

		//var_dump($code);exit;
		$response = @eval('?>'.$code.'<?php;');

		if(error_get_last())
		{
			$line = error_get_last()['line'];
			$error = error_get_last()['message'];

			throw new \Exception('Bad Template! With Error: "'.$error.'" on Line '.$line.'.');
		}

		$result = ob_get_clean();
		ob_end_clean();
		return $result;
	}

	public function setControllerAction($action)
	{
		$this->action = $action;
	}

} 