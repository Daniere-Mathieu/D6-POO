<?php

namespace MyClass;

use MyInterface\AnimalInterface;
use MyClass\Diet;
use MyClass\Species;

require_once 'Species.php';
require_once 'Diet.php';
require_once 'interface/AnimalInterface.php';

/**
 * Represents an animal that belongs to a certain species
 * Implements the AnimalInterface
 */
class Animal extends Species implements AnimalInterface
{

	private int $numberOfMembers;
	private Diet $diet;
	private Species $species;
	private int $lifeExpectancy;
	private int $gestationPeriod;
	private string $name;

	/**
	 * Animal constructor.
	 * @param string $species The name of the species
	 * @param string $name The name of the animal
	 */
	public function __construct(string $species, string $name)
	{
		$this->numberOfMembers = 0;
		$this->diet = new Diet();
		$this->$species = new Species($species);
		$this->lifeExpectancy = 0;
		$this->gestationPeriod = 0;
		$this->name = $name;
	}

	/**
	 * Method to handle when the animal passes away
	 * @return void
	 */
	public function passAway()
	{
		unset($this);
	}

	/**
	 * Method to get the name of the animal.
	 * @return string The name of the animal.
	 */
	public function getName()
	{
		return $this->name;
	}
}
