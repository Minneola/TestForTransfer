<?php
/**
 * This file is part of the Minneola Project.
 * Copyright (c) 2016 Tobias Maxham <git2016@maxham.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Feel free to edit as you please, and have fun.
 */

namespace Minneola\TestFoo\Fichier;

/**
 * Class Fichier
 * @package Minneola\TestFoo\Fichier
 * @author Tobias Maxham
 */
class Fichier
{

	/**
	 * @param $rut
	 * @return int
	 */
	public function getSize($rut)
	{
		return filesize($rut);
	}

	/**
	 * @param $rut
	 * @return string
	 * @throws \Exception
	 */
	public function getFichier($rut)
	{
		if (file_exists($rut)) return file_get_contents($rut);
		throw new \Exception("File does not exists {$rut}");
	}

	/**
	 * @param $rut
	 * @return string
	 */
	public function getType($rut)
	{
		return filetype($rut);
	}

	/**
	 * @param $rut
	 * @return mixed
	 */
	public function getName($rut)
	{
		return pathinfo($rut, PATHINFO_FILENAME);
	}

	/**
	 * @param $rut
	 * @param $path
	 */
	public function doCopy($rut, $path)
	{
		copy($rut, $path);
	}

	/**
	 * @param $rut
	 * @param $path
	 */
	public function doMove($rut, $path)
	{
		rename($rut, $path);
	}

	/**
	 * @param $rut
	 */
	public function doDelete($rut)
	{
		unlink($rut);
	}

	/**
	 * @param $rut
	 * @param $content
	 */
	public function doAdd($rut, $content)
	{
		file_put_contents($rut, $content, LOCK_EX);
	}

} 