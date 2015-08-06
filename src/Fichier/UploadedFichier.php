<?php

namespace Minneola\TestFoo\Fichier;

/**
 * Class UploadedFichier
 * @package Minneola\TestFoo\Fichier
 * @author Tobias Maxham
 * @version 06.08.2015
 */
class UploadedFichier extends \SplFileInfo
{

	public $originalName;
	public $size;
	public $fileType;
	public $error;

	public function __construct($path, $name, $type, $size, $error)
	{

		$this->originalName = $name;
		$this->fileType = $type;
		$this->size = $size;
		$this->error = $error;

		parent::__construct($path);
	}

} 