<?php

namespace Minneola\TestFoo\Fichier;

/**
 * Class FichierManager
 * @package Minneola\TestFoo\Fichier
 * @author Tobias Maxham
 */
class FichierManager
{

	/**
	 * @var Fichier $fichier
	 */
	private $fichier;

	/**
	 * The filepath.
	 *
	 * @var string $rut
	 */
	private $rut;

	/**
	 * @var string $content
	 */
	private $content;

	/**
	 * @param string $rut
	 * @throws \Exception
	 */
	public function __construct($rut)
	{
		$this->fichier = new Fichier();
		$this->rut = $rut;
		$this->content = $this->fichier->getFichier($rut);
	}

	public function __call($method, $args)
	{
		if (method_exists($this->fichier, $method)) {
			switch (count($args)) {
				case 1:
					return $this->fichier->{$method}($this->rut, $args[0]);
				case 2:
					return $this->fichier->{$method}($this->rut, $args[0], $args[1]);
				default:
					return $this->fichier->{$method}($this->rut);
			}
		}

		return NULL;
	}

	/**
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

} 