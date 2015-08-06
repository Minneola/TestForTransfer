<?php

namespace Minneola\TestFoo\Pod;

use Minneola\TestFoo\Fichier\UploadedFichier;

/**
 * Class Podanie
 * @package Minneola\TestFoo\Pod
 */
class Podanie
{

	public function get($key)
	{
		if(isset($_POST[$key])) return $_POST[$key];
		if(isset($_GET[$key])) return $_GET[$key];
		if(isset($_FILES[$key])) return $this->getFileFor($key);
		return NULL;
	}

	public function all($method = NULL)
	{
		if(strtolower($method) == 'get') return $_GET;
		if(strtolower($method) == 'post') return $_POST;
		if(strtolower($method) == 'file' || strtolower($method) == 'files') return $_FILES;
		return array_merge($_GET, $_POST, $this->getFileArray());
	}

	public function file($key)
	{
		if(isset($_FILES[$key])) return $this->getFileFor($key);
		return NULL;
	}

	/**
	 * @param $key
	 * @return \Minneola\TestFoo\Fichier\UploadedFichier
	 */
	private function getFileFor($key)
	{
		$file = $_FILES[$key];
		return new UploadedFichier(
			$file['tmp_name'], $file['name'], $file['type'], $file['size'], $file['error']
		);
	}

	private function getFileArray()
	{
		if(empty($_FILES)) return [];
		$arr = [];
		foreach($_FILES as $key => $aFile)
		{
			$arr[$key] = $this->getFileFor($key);
		}
		return $arr;
	}

}
